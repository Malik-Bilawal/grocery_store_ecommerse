<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class CategoryPageController extends Controller
{
    public function index(){
        $subcategories = SubCategory::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('user.category', compact('categories', 'subcategories'));
    }
}
