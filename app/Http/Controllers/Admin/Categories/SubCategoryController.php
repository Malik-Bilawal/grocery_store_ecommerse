<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
    
        $subcategories = SubCategory::with('category')
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
    
        return view('admin.categories.subcategory', compact('categories', 'subcategories'));
    }
    

    public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    $subcategory = SubCategory::create([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    if ($request->wantsJson() || $request->is('api/*')) {
        return response()->json([
            'status' => true,
            'message' => 'SubCategory added successfully!',
            'data' => $subcategory
        ], 201);
    }

    return back()->with('success', 'SubCategory added successfully!');
}


public function update(Request $request, $id)
{
    $subcategory = SubCategory::findOrFail($id);

    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:active,inactive',
    ]);

    $subcategory->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    if ($request->wantsJson() || $request->is('api/*')) {
        return response()->json([
            'status' => true,
            'message' => 'SubCategory updated successfully!',
            'data' => $subcategory
        ]);
    }

    return back()->with('success', 'SubCategory updated successfully!');
}




public function destroy(Request $request, $id)
{
    $subcategory = SubCategory::findOrFail($id);
    $subcategory->delete();

    if ($request->wantsJson() || $request->is('api/*')) {
        return response()->json([
            'status' => true,
            'message' => 'SubCategory deleted successfully!'
        ]);
    }

    return back()->with('success', 'SubCategory deleted successfully!');
}

}

