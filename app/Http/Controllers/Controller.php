<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    public function __construct()
{
    $mostBoughtProduct = OrderItem::select(
            'products.name',
            DB::raw('SUM(order_items.quantity) as total_quantity')
        )
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('order_addresses', 'order_addresses.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->groupBy('products.name')
        ->orderByDesc('total_quantity')
        ->take(6)
        ->get();

    View::share('mostBoughtProduct', $mostBoughtProduct);
}
}
