@extends('admin.layouts.master-layouts.plain')

@section('title', 'Dashboard')

@section('style')
<style>
    .stat-card:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease-in-out;
    }
    
    .chart-container {
        height: 300px;
    }
    
    @media (max-width: 768px) {
        .chart-container {
            height: 250px;
        }
    }
</style>
@endsection

@section('content')

<div
    x-data="{ sidebarOpen: false }"
    @close-sidebar.window="sidebarOpen = false"
    class="flex h-screen overflow-hidden">

    <!-- Mobile backdrop -->
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"></div>


    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak>
        @include("admin.layouts.partial.sidebar")
    </aside>


    <div class="flex-1 flex flex-col h-screen overflow-y-auto lg:ml-64 bg-gradient-to-br from-gray-50 to-gray-100 p-6">    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
        <p class="text-gray-600 mt-2">Welcome back! Here's what's happening with your store today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-white rounded-xl shadow-md p-6 stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalOrders) }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-clock mr-1"></i>
                    <span>{{ $pendingOrders }} pending</span>
                </div>
            </div>
        </div>

        <!-- Today's Revenue -->
        <div class="bg-white rounded-xl shadow-md p-6 stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Today's Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">RS.{{ number_format($todayRevenue, 2) }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-calendar-day mr-1"></i>
                    <span>{{ $todayOrders }} orders today</span>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white rounded-xl shadow-md p-6 stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Products</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalProducts) }}</h3>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <i class="fas fa-box-open text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-layer-group mr-1"></i>
                    <span>{{ $totalCategories }} categories</span>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="bg-white rounded-xl shadow-md p-6 stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Messages</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalMessages) }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-envelope text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-inbox mr-1"></i>
                    <span>Customer inquiries</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Sales Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Sales Analytics</h2>
                <span class="text-sm text-gray-500">Last 7 Days</span>
            </div>
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Order Status Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Order Status</h2>
                <span class="text-sm text-gray-500">Current Status</span>
            </div>
            <div class="chart-container">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Data Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Orders -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Recent Orders</h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="#" class="text-blue-600 hover:text-blue-900 font-medium">
                                    #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->user)
                                <div class="text-sm text-gray-900">{{ $order->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                @else
                                <div class="text-sm text-gray-500">Guest</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                RS.{{ number_format($order->total, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                    @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No orders found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Messages & Top Products -->
        <div class="space-y-8">
            <!-- Recent Messages -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800">Recent Messages</h2>
                        <a href="{{ route('admin.contact.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View All
                        </a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentMessages as $message)
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-sm font-medium text-gray-900">{{ $message->subject }}</h3>
                                <p class="text-sm text-gray-600 mt-1 truncate">{{ Str::limit($message->message, 50) }}</p>
                            </div>
                            <span class="text-xs text-gray-500">{{ $message->created_at->format('M d') }}</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <span>{{ $message->first_name }} {{ $message->last_name }}</span>
                            <span class="mx-1">•</span>
                            <span>{{ $message->email }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-4 text-center text-gray-500">No messages found</div>
                    @endforelse
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Top Selling Products</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($topProducts as $product)
                    <div class="px-6 py-4 hover:bg-gray-50 flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-gray-500"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex justify-between">
                                <h3 class="text-sm font-medium text-gray-900">{{ $product->name }}</h3>
                                <span class="text-sm text-gray-900 font-medium">{{ $product->total_sold ?? 0 }} sold</span>
                            </div>
                            <p class="text-sm text-gray-500">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-4 text-center text-gray-500">No products found</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue -->
    <div class="mt-8 bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Monthly Performance</h2>
                <p class="text-gray-600 mt-1">Total revenue for current month</p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold text-gray-800">RS.{{ number_format($currentMonthRevenue, 2) }}</div>
                <div class="text-sm text-gray-500 mt-1">Current Month Revenue</div>
            </div>
        </div>
        <div class="h-4 bg-gray-200 rounded-full overflow-hidden">
            @php
                $progress = $currentMonthRevenue > 0 ? min(($currentMonthRevenue / 50000) * 100, 100) : 0;
            @endphp
            <div class="h-full bg-gradient-to-r from-blue-500 to-purple-600 rounded-full" 
                 style="width: {{ $progress }}%"></div>
        </div>
        <div class="mt-2 text-sm text-gray-500 flex justify-between">
            <span>Target: $50,000</span>
            <span>{{ number_format($progress, 1) }}%</span>
        </div>
    </div>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: @json($salesData['labels']),
                datasets: [{
                    label: 'Revenue',
                    data: @json($salesData['revenue']),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Orders',
                    data: @json($salesData['orders']),
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Order Status Chart
        const statusCtx = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
                datasets: [{
                    data: [
                        {{ $orderStatusCounts['pending'] }},
                        {{ $orderStatusCounts['processing'] }},
                        {{ $orderStatusCounts['shipped'] }},
                        {{ $orderStatusCounts['delivered'] }},
                        {{ $orderStatusCounts['cancelled'] }}
                    ],
                    backgroundColor: [
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(147, 51, 234, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgb(245, 158, 11)',
                        'rgb(59, 130, 246)',
                        'rgb(147, 51, 234)',
                        'rgb(16, 185, 129)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                },
                cutout: '70%'
            }
        });

        // Update dashboard every 60 seconds
        setInterval(() => {
            location.reload();
        }, 60000);
    });
</script>
@endpush
@endsection