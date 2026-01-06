<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $categories = $query->orderBy('created_at', 'desc')->paginate(5);
    
        return view('admin.categories.category', compact('categories'));
    } 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:1,0',
            'image' => 'nullable|image|max:2048'
        ]);
    
        // create category first
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->storeAs('uploads/categories/images', time() . '_' . $file->getClientOriginalName(), 'public');
            $category->image = $path;
            $category->save(); 
        } 
    
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status' => true,
                'message' => 'Category added successfully!',
                'data' => $category
            ], 201);
        }
    
        return back()->with('success', 'Category added successfully!');
    }

    
    public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'name' => 'required|unique:categories,name,' . $id,
        'description' => 'nullable|string|max:500',
        'status' => 'required|in:1,0',
        'image' => 'nullable|image|max:2048'
    ]);

    // update main fields
    $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'status' => $request->status,
    ]);

    // handle image upload
    if ($request->hasFile('image')) {

        // delete old image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // upload new
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/categories/images', $filename, 'public');

        $category->image = $path;
        $category->save();

   

    if ($request->wantsJson() || $request->is('api/*')) {
        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully!',
            'data' => $category
        ]);
    }

    return back()->with('success', 'Category updated successfully!');
}


}

public function destroy(Request $request, $id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    if ($request->wantsJson() || $request->is('api/*')) {
        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully!'
        ]);
    }

    return back()->with('success', 'Category deleted successfully!');
}

}