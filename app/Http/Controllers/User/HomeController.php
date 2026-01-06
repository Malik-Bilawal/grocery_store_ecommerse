<?php

namespace App\Http\Controllers\User;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $activeSale = Sale::where('starts_at', '<=', now())
        ->where('ends_at', '>=', now())
        ->first();
        $heroSliders = HeroSlider::where('status', 1)->get();
       
        $categories = Category::with('subcategories')->get(); // You said you have 5
        $products = Product::with('images')->where('status', 1)->take(12)->get();



        return view('user.index', compact('heroSliders', 'categories', 'products', 'activeSale'));
    }
    
}




