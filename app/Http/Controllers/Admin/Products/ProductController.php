<?php

namespace App\Http\Controllers\Admin\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('subcategory', 'category', 'sizes', 'images');
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->subcategory_id);
        }
    
        $products = $query->paginate(10)->withQueryString();
    
        $categories = Category::all();
    
        return view('admin.products.index', compact('products', 'categories'));
    }
    
    

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function getSubcategories($categoryId)
{
    $subcategories = Subcategory::where('category_id', $categoryId)->get(['id','name']);
    return response()->json($subcategories);
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id',
        'price' => 'required|numeric|min:0',
        'weight' => 'required|numeric|min:0',
        'rating' => 'required|numeric|max:5',
        'sizes.*.size' => 'required|string',
        'sizes.*.price' => 'required|numeric|min:0',
        'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        'additional_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ]);
    
    $category = Category::find($request->category_id);
    
    $catName = $category->name;
    $prefix = strtoupper(substr($catName, 0, 1) . substr($catName, -1));


    $latestProduct = Product::where('sku', 'LIKE', "{$prefix}-%")
                            ->orderBy('id', 'desc')
                            ->first();

    if ($latestProduct) {
        $parts = explode('-', $latestProduct->sku);
        $number = intval(end($parts)) + 1;
    } else {
        $number = 1;
    }

    $generatedSku = "{$prefix}-{$number}";

    $product = Product::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'sku'  => $generatedSku,
        'description' => $request->description,
        'price' => $request->price,
        'offer_price' => $request->offer_price,
        'stock' => $request->stock,
        'weight' => $request->weight,
        'rating'=> $request->rating,
        'status' => $request->status,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id ?? null,
    ]);
    

    //   images
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        $path = $file->store("products/{$product->id}/main_image", 'public'); 

        $product->images()->create([
            'image_path' => $path,  
            'is_default' => 1
        ]);
    }

    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $file) {
            $path = $file->store("products/{$product->id}/sub_images", 'public');
            $product->images()->create([
                'image_path' => $path,
                'is_default' => 0
            ]);
        }
    }

//sizess
    if ($request->has('sizes')) {
        foreach ($request->sizes as $size) {
            $product->sizes()->create([
                'size' => $size['size'],
                'price' => $size['price'],
            ]);
        }
    }

    if ($request->wantsJson() || $request->is('api/*')) {
        $product->load(['images', 'sizes']);

        return response()->json([
            'status' => true,
            'message' => 'Product added successfully!',
            'data' => $product
        ], 201);
    }

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product added successfully!');
}


public function edit($id)
{
    $product = Product::with('sizes', 'images')->findOrFail($id);
    $categories = Category::all();
    $subcategories = SubCategory::where('category_id', $product->category_id)->get();

    if (request()->wantsJson()) {
        return response()->json([
            'success' => true,
            'product' => $product,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
}


public function update(Request $request, $id)
{
    $product = Product::with('images', 'sizes')->findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'sizes.*.size' => 'required|string',
        'rating' => 'required|numeric|max:5',
        'sizes.*.price' => 'required|numeric|min:0',
        'weight' => 'required|numeric|min:0',
        'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        'subcategory_id' => 'nullable|exists:sub_categories,id',


    ]);

    $sku = $product->sku; 


    if ($request->category_id != $product->category_id || empty($product->sku)) {
        
        $category = Category::find($request->category_id);
        
        $catName = $category->name;
        $prefix = strtoupper(substr($catName, 0, 1) . substr($catName, -1));

        $latestProduct = Product::where('sku', 'LIKE', "{$prefix}-%")
                                ->where('id', '!=', $product->id) 
                                ->orderBy('id', 'desc')
                                ->first();

        if ($latestProduct) {
            $parts = explode('-', $latestProduct->sku);
            $number = intval(end($parts)) + 1;
        } else {
            $number = 1;
        }

        $sku = "{$prefix}-{$number}";
    }
    $product->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'price' => $request->price,
        'sku'  => $sku, 
        'offer_price' => $request->offer_price,
        'stock' => $request->stock,
        'rating' => $request->rating,
        'weight' => $request->weight,
        'status' => $request->status,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id ?? null,
    ]);

if ($request->hasFile('main_image')) {
    $oldMain = $product->images()->where('is_default', 1)->first();
    if ($oldMain) {
        Storage::disk('public')->delete($oldMain->image_path);
        $oldMain->delete();
    }

    $file = $request->file('main_image');
    $path = $file->store("products/{$product->id}/main_image", 'public');

    $product->images()->create([
        'image_path' => $path,
        'is_default' => 1
    ]);
}

if ($request->filled('deleted_images')) {
    $deletedIds = $request->deleted_images;
    $imagesToDelete = $product->images()->whereIn('id', $deletedIds)->get();
    foreach ($imagesToDelete as $img) {
        Storage::disk('public')->delete($img->image_path);
        $img->delete();
    }
}

if ($request->hasFile('additional_images')) {
    foreach ($request->file('additional_images') as $file) {
        $path = $file->store("products/{$product->id}/sub_images", 'public');
        $product->images()->create([
            'image_path' => $path,
            'is_default' => 0
        ]);
    }
}

    if ($request->has('sizes')) {
        $product->sizes()->delete();

        foreach ($request->sizes as $size) {
            $product->sizes()->create([
                'size' => $size['size'],
                'price' => $size['price'],
            ]);
        }
    }

    if ($request->wantsJson() || $request->is('api/*')) {
        $product->load(['images', 'sizes']);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully!',
            'data' => $product
        ], 201);
    }

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
}

public function destroy($id)
{
    $product = Product::with('images', 'sizes')->findOrFail($id);

    $folderPath = "products/{$product->id}";
    if (Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->deleteDirectory($folderPath);
    }

    $product->sizes()->delete();
    $product->images()->delete();
    $product->delete();

    if (request()->wantsJson() || request()->ajax() || request()->is('api/*')) {
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!'
        ]);
    }

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
}

}
