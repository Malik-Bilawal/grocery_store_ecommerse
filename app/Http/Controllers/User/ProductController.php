<?php

namespace App\Http\Controllers\User;

use id;
use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function show($slug)
    {
        // Get product by slug
        $product = Product::with(['images', 'sizes', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();
    
        $hasOrdered = false;
    
        // Check if logged in
        if (auth()->check()) {
            $hasOrdered = DB::table('order_items')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.user_id', auth()->id())
                ->where('order_items.product_id', $product->id)
                ->exists();
        }
    
        return view('user.product.product-detail', compact('product', 'hasOrdered'));
    }
    


    public function reviewStore(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please log in first.'
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Review submitted successfully!',
            'review' => $review
        ]);
    }
public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'size' => 'nullable|string',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric',
    ]);

    $product = Product::findOrFail($request->product_id);
    $quantity = $request->quantity;
    $price = $request->price;
    $total = $price * $quantity;
    if (Auth::check()) {
        $userId = Auth::id();
        $guestToken = null;
    } else {
        $userId = null;
    
        $guestToken = session('guest_token') 
            ?? Cookie::get('guest_token') 
            ?? Str::uuid();
    
        session(['guest_token' => $guestToken]);
        Cookie::queue(Cookie::make('guest_token', $guestToken, 60 * 24 * 30, null, null, false, false)); 
    
    }
    

    $existing = Cart::where(function ($query) use ($userId, $guestToken) {
        if ($userId) $query->where('user_id', $userId);
        else $query->where('guest_token', $guestToken);
    })
    ->where('product_id', $product->id)
    ->where('size', $request->size)
    ->first();

    if ($existing) {
        $existing->quantity += $quantity;
        $existing->total = $existing->price * $existing->quantity;
        $existing->save();
    } else {
        Cart::create([
            'user_id' => $userId,
            'guest_token' => $guestToken,
            'product_id' => $product->id,
            'size' => $request->size,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total,
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Product added to cart!');
}


public function buyNow(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'size' => 'nullable|string',
        'price' => 'required|numeric',
    ]);

    $product = Product::findOrFail($request->product_id);

    // Store in session
    session(['buy_now_item' => [
        'product_id' => $product->id,
        'name' => $product->name,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'size' => $request->size,
        'image' => $product->image,
    ]]);

    return response()->json(['success' => true]);
}

}
