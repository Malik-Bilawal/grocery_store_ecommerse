<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\ContactMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCategories = Category::count();
        $totalMessages = ContactMessage::count();
        
        // Today's Stats
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $todayRevenue = Order::whereDate('created_at', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->sum('total');
            
        // Monthly Revenue
        $currentMonthRevenue = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', '!=', 'cancelled')
            ->sum('total');
            
        // Pending Orders
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Recent Orders (last 10)
        $recentOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(10)
            ->get();
            
        // Recent Messages (last 5)
        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();
            
        $salesData = $this->getSalesData(7);
        
        $topProducts = Product::withCount(['orderItems as total_sold' => function($query) {
            $query->whereHas('order', function($q) {
                $q->where('status', '!=', 'cancelled');
            });
        }])
        ->orderBy('total_sold', 'desc')
        ->take(5)
        ->get();
        
        // Order Status Breakdown
        $orderStatusCounts = $this->getOrderStatusCounts();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCategories',
            'totalMessages',
            'todayOrders',
            'todayRevenue',
            'currentMonthRevenue',
            'pendingOrders',
            'recentOrders',
            'recentMessages',
            'salesData',
            'topProducts',
            'orderStatusCounts'
        ));
    }
    
    private function getSalesData($days = 7)
    {
        $salesData = [];
        $dates = collect();
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates->push($date->format('Y-m-d'));
        }
        
        foreach ($dates as $date) {
            $total = Order::whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->sum('total');
                
            $count = Order::whereDate('created_at', $date)->count();
            
            $salesData['labels'][] = Carbon::parse($date)->format('M d');
            $salesData['revenue'][] = $total;
            $salesData['orders'][] = $count;
        }
        
        return $salesData;
    }
    
    private function getOrderStatusCounts()
    {
        return [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
    }
}