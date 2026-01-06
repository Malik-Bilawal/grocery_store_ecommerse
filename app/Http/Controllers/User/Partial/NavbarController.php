<?php

namespace App\Http\Controllers\User\Partial;

use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NavbarController extends Controller
{
    public function search(Request $request)
{
    $query = $request->q;

    $products = Product::with('images')
        ->where('name', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->take(10)
        ->get();

    $results = $products->map(function ($p) {
        $image = $p->images->where('is_default', 1)->first() ?? $p->images->first();
        return [
            'id' => $p->id,
            'name' => $p->name,
            'slug' => $p->slug,         
            'price' => $p->price,
            'offer_price' => $p->offer_price,
            'image' => $image ? $image->image_path : null,
        ];
    });

    return response()->json($results);
}

}
