<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public  function index()
    {
        $orders = Order::with('user', 'items.product', 'addresses')->latest()->get();

        return view('admin.order.order', compact('orders'));

    }

    public function show($id)
    {
        $order = Order::with([
            'user',
            'items.product.default_image', // <-- FIXED
            'addresses'
        ])->findOrFail($id);
    
        return view('admin.order.order-detail', compact('order'));
    }
    

    public function statusUpdate(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

}
