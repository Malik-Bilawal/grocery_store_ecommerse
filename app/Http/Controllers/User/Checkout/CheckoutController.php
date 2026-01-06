<?php

namespace App\Http\Controllers\User\Checkout;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\AdminOrderAlertMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(Request $request)
{
    $shipping = 250;
    $tax = 0;
    $cartItems = collect();

    $source = $request->query('source', 'cart');

    if ($source !== 'buy_now') {
        session()->forget('buy_now_item');
    }

    if ($source === 'buy_now' && session()->has('buy_now_item')) {
        $buyNow = session('buy_now_item');
        $product = Product::with('images')->find($buyNow['product_id']);

        if ($product) {
            $cartItems->push((object)[
                'id'       => null,
                'product'  => $product,
                'quantity' => $buyNow['quantity'],
                'size'     => $buyNow['size'] ?? null,
                'price'    => $buyNow['price'] ?? $product->price,
                'name'     => $product->name,
                'image'    => $product->images->first()->image_path ?? null,
                'from'     => 'buy_now',
            ]);
        }

        return view('user.checkout.checkout', compact('cartItems', 'shipping', 'tax'));
    }

    $cart = collect();

    if (Auth::check()) {
        $cart = Cart::where('user_id', Auth::id())->with('product.images')->get();
    } else {
        $guestToken = session('guest_token') ?? Cookie::get('guest_token');
        if ($guestToken) {
            $cart = Cart::where('guest_token', $guestToken)->with('product.images')->get();
        }
    }

    foreach ($cart as $item) {
        if ($item->product) {
            $cartItems->push((object)[
                'id'       => $item->id,
                'product'  => $item->product,
                'quantity' => $item->quantity,
                'size'     => $item->size,
                'price'    => $item->price,
                'name'     => $item->product->name,
                'image'    => $item->product->images->first()->image_path ?? null,
                'from'     => 'cart',
            ]);
        }
    }

    return view('user.checkout.checkout', compact('cartItems', 'shipping', 'tax'));
}


public function placeOrder(Request $request)
{

    $validated = $request->validate([
        'first_name'  => 'required|string|max:255',
        'last_name'   => 'required|string|max:255',
        'email'       => 'required|email',
        'phone'       => 'required|string',
        'address'     => 'required|string',
        'city'        => 'required|string',
        'postal_code' => 'required|string',
    ]);

 

    DB::beginTransaction();

    try {
        if (Session::has('buy_now_item')) {
            $cartItems = collect([Session::get('buy_now_item')]);
            Session::forget('buy_now_item');
        } else {
            if (Auth::check()) {
                $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            
            } else {
                $guestToken = session('guest_token') ?? Cookie::get('guest_token');
                if ($guestToken instanceof \Ramsey\Uuid\UuidInterface) {
                    $guestToken = $guestToken->toString();
                }

                $cartItems = $guestToken
                    ? Cart::where('guest_token', $guestToken)->with('product')->get()
                    : collect();

               
            }
        }

    

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum(function ($i) {
            $price = is_array($i) ? ($i['price'] ?? 0) : ($i->price ?? ($i->product->price ?? 0));
            $qty = is_array($i) ? ($i['quantity'] ?? 1) : ($i->quantity ?? 1);
            return $price * $qty;
        });

        $shipping = 250;
        $tax = 0;

        $now = Carbon::now('Asia/Karachi');
        $activeSale = Sale::where('starts_at', '<=', $now)
            ->where('ends_at', '>=', $now)
            ->first();


        $discount = 0;
        if ($activeSale) {
            $discount = ($subtotal * $activeSale->discount_percent) / 100;
        
        } 

        $total = $subtotal - $discount + $shipping + $tax;

        $order = Order::create([
            'user_id'        => Auth::id(),
            'guest_token'    => Auth::check() ? null : session('guest_token'),
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'tax'            => $tax,
            'discount'       => $discount,
            'total'          => $total,
            'payment_method' => 'cod',
            'status'         => 'pending',
        ]);


        foreach ($cartItems as $index => $item) {
            try {
           
                $productId = is_array($item)
                    ? ($item['product_id'] ?? null)
                    : ($item->product_id ?? ($item->product->id ?? null));

                $quantity = is_array($item)
                    ? ($item['quantity'] ?? 1)
                    : ($item->quantity ?? 1);

                $size = is_array($item)
                    ? ($item['size'] ?? null)
                    : ($item->size ?? null);

                $price = is_array($item)
                    ? ($item['price'] ?? 0)
                    : ($item->price ?? ($item->product->price ?? 0));


                if (!$productId) {
                    throw new \Exception("Missing product_id for item index {$index}");
                }

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'size'       => $size,
                    'quantity'   => $quantity,
                    'price'      => $price,
                    'total'      => $price * $quantity,
                ]);

             
            } catch (\Throwable $itemErr) {
            
                throw $itemErr;
            }
        }





try {
 

    $shipping = OrderAddress::create([
        'order_id'    => $order->id,
        'type'        => 'shipping',
        'first_name'  => $validated['first_name'],
        'last_name'   => $validated['last_name'],
        'email'       => $validated['email'],
        'phone'       => $validated['phone'],
        'address'     => $validated['address'],
        'city'        => $validated['city'],
        'postal_code' => $validated['postal_code'],
        'country'     => 'Pakistan',
    ]);

   

} catch (\Exception $e) {
 ;
    throw $e;
}

$isSameBilling = $request->boolean('same_billing', false);



try {
    if ($isSameBilling) {
   

        $billing = OrderAddress::create([
            'order_id'    => $order->id,
            'type'        => 'billing',
            'first_name'  => $validated['first_name'],
            'last_name'   => $validated['last_name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'address'     => $validated['address'],
            'city'        => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'country'     => 'Pakistan',
        ]);

     

    } else {
     
        $billing = OrderAddress::create([
            'order_id'    => $order->id,
            'type'        => 'billing',
            'first_name'  => $request->input('billing_first_name') ?? 'N/A',
            'last_name'   => $request->input('billing_last_name') ?? 'N/A',
            'email'       => $request->input('billing_email') ?? $validated['email'],
            'phone'       => $request->input('billing_phone') ?? $validated['phone'],
            'address'     => $request->input('billing_address') ?? $validated['address'],
            'city'        => $request->input('billing_city') ?? $validated['city'],
            'postal_code' => $request->input('billing_postal_code') ?? $validated['postal_code'],
            'country'     => 'Pakistan',
        ]);

      
    }

} catch (\Exception $e) {

    throw $e;
}








        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            $guestToken = session('guest_token') ?? Cookie::get('guest_token');
            Cart::where('guest_token', $guestToken)->delete();
        }

        DB::commit();

 
$order->load('addresses', 'items.product.default_image');

try {
    Mail::to($validated['email'])
        ->queue(new OrderPlacedMail($order));

    Mail::to('team@grocerystationone.com')
        ->queue(new AdminOrderAlertMail($order));
} catch (\Throwable $e) {
    Log::error('Order mail failed', [
        'order_id' => $order->id,
        'error' => $e->getMessage(),
    ]);
}

        return redirect()->route('order.confirmation', ['order' => $order->id]);

    } catch (\Exception $e) {
        DB::rollBack();
       
        return back()->with('error', 'Something went wrong! ' . $e->getMessage());
    }

}

public function confirmation($orderId)
{
    $order = Order::with(['items.product', 'addresses'])->findOrFail($orderId);

    return view('user.checkout.confirmation', compact('order'));
}

public function downloadInvoice($orderId)
{
    $order = Order::with(['items.product', 'addresses'])->findOrFail($orderId);

    $pdf = Pdf::loadView('user.checkout.invoice', compact('order'));
    return $pdf->download("invoice_{$order->id}.pdf");
}


}
    
    
    


    

