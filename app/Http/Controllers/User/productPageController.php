<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class productPageController extends Controller
{
    public function index(Request $request){

        $priceStats = Product::toBase()
                        ->selectRaw('min(price) as min_price, max(price) as max_price')
                        ->first();
    
        $minPrice = $priceStats->min_price ?? 0;
        $maxPrice = $priceStats->max_price ?? 0;
    
        $categories = Category::withCount(['directProducts', 'subcategoryProducts'])
                        ->where('status', 1)
                        ->get();
    
        $products = Product::with('subcategory','images', 'sizes')->paginate(12);
        $totalProducts = Product::count();
    
        return view('user.product', compact('products', 'categories', 'minPrice','maxPrice','totalProducts'));
    }
    public function filterProducts(Request $request)
    {
        $query = Product::query();
    
        if ($request->filled('category_id')) {
            Log::info('Applying category filter with category_id: ' . $request->category_id);
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
    
        if ($request->filled('ratings')) {
            $query->where('rating', $request->ratings);
        }
    
        if ($request->filled('availability') && in_array('In Stock', (array) $request->availability)) {
        }
    
        $perPage = 12;
        $page = $request->get('page', 1);
        $products = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Render HTML
        $html = view('user.components.product-cards', compact('products'))->render();
    
        return response()->json([
            'html' => $html,
            'count' => $products->total(),
            'last_page' => $products->lastPage(),
            'current_page' => $products->currentPage(),
        ]);
    }

}