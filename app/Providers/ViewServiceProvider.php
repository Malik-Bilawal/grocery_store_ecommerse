<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Automatically pass popular products to the navbar
        View::composer('user.layouts.partial.navbar', function ($view) {
            $mostBoughtProduct = OrderItem::select(
                    'products.id',
                    'products.name',
                    DB::raw('SUM(order_items.quantity) as total_quantity')
                )
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->join('order_addresses', 'orders.address_id', '=', 'order_addresses.id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->groupBy('products.id', 'products.name')
                ->orderByDesc('total_quantity')
                ->take(6)
                ->get();

            $view->with('mostBoughtProduct', $mostBoughtProduct);
        });
    }
}
