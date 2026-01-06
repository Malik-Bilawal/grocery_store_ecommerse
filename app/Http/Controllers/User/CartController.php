<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Sale;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $query = Cart::query();

        $cartItems = $query->with(['product.images', 'product.default_image'])->get();
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        } else {
            $guestToken = session('guest_token');
            if (!$guestToken) {
                $guestToken = Str::uuid();
                session(['guest_token' => $guestToken]);
            }
            $query->where('guest_token', $guestToken);
        }


    $activeSale = Sale::where('starts_at', '<=', now())
    ->where('ends_at', '>=', now())
    ->first();


        $cartItems = $query->with('product')->get();

        return view('user.cart', compact('cartItems', 'activeSale'));
    }


    public function updateQuantity(Request $request, $id)
    {
        $action = $request->input('action');
    
        $userId = auth()->id();
    
        $guestToken = $request->cookie('guest_token')
            ?? session('guest_token')
            ?? $request->input('guest_token');
    

    
        $cart = Cart::where('id', $id)
            ->where(function ($query) use ($userId, $guestToken) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('guest_token', $guestToken);
                }
            })
            ->first();
    
        if (!$cart) {
  
            return response()->json(['error' => 'Cart not found'], 404);
        }
    
        if ($action === 'increase') {
            $cart->quantity++;
        } elseif ($action === 'decrease' && $cart->quantity > 1) {
            $cart->quantity--;
        }
    
        $cart->total = $cart->price * $cart->quantity;
        $cart->save();
    
        return response()->json(['success' => true, 'quantity' => $cart->quantity]);
    }
    
    
    

public function remove($id)
{
    Cart::findOrFail($id)->delete();
    return response()->json(['success' => true]);
}

}
