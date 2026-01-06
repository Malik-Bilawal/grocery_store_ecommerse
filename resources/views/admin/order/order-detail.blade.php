@extends("admin.layouts.master-layouts.plain")

<title>Category | Grocery Store</title>

@push("script")
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#10b981',
                    secondary: '#1f2937'
                }
            }
        }
    }
</script>
@endpush

@push("style")
<style>
  /* Prevent flash before Alpine loads */
  [x-cloak] { display: none !important; }
</style>
@endpush

@section("content")
<!-- Root wrapper with Alpine state -->
<!-- Root wrapper with Alpine state -->
<div 
    x-data="{ sidebarOpen: false }" 
    @close-sidebar.window="sidebarOpen = false" 
    class="flex h-screen overflow-hidden"
>

    <!-- Mobile backdrop -->
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
        @click="sidebarOpen = false"
    ></div>


    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        x-cloak
    >
        @include("admin.layouts.partial.sidebar")
    </aside>

    <!-- Main content wrapper (push right on large screens) -->
    <div class="flex-1 flex flex-col overflow-hidden lg:ml-64 bg-gradient-to-br from-gray-50 to-gray-100">

       
        <!-- Main -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6">
            @yield('admin-content') 
            <div class="max-w-7xl mx-auto">

{{-- Header --}}
<div class="flex justify-between items-center mb-8 fade-in">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            Order Details
        </h1>
        <p class="text-gray-500 mt-2">
            Order code: 
            <span class="font-mono bg-blue-50 text-blue-600 px-2 py-1 rounded-md">
                {{ $order->id ? "ORD-".str_pad($order->id,6,"0",STR_PAD_LEFT) : 'N/A' }}
            </span>
        </p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-white text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 hover-lift flex items-center shadow-sm">
            Back to Orders
        </a>
      
    </div>
</div>

{{-- Status Bar --}}
<div class="bg-white rounded-xl shadow-sm p-5 mb-6 fade-in">
    <div class="flex justify-between items-center">
        <div class="flex items-center">
            <span class="text-lg font-medium text-gray-700 mr-3">Order Status:</span>
            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status == 'completed') bg-green-100 text-green-800
                @elseif($order->status == 'canceled') bg-red-100 text-red-800
                @endif
            ">
                {{ ucfirst($order->status ?? 'N/A') }}
            </span>
        </div>
        <div class="flex space-x-2">
        <div class="flex space-x-2">
<form action="{{ route('admin.orders.statusUpdate', $order->id) }}" method="POST">
@csrf
@method('PUT') {{-- or PATCH, depending on your route --}}
<select name="status" onchange="this.form.submit()" class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-sm hover:bg-blue-100 transition-colors">
<option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
<option value="completed" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
<option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
<option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
</select>

<button type="submit" class="hidden px-3 py-1 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600 transition-colors">
Update Status

</button>
</form>


</div>

            <button class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-sm hover:bg-red-100 transition-colors">
                Cancel Order
            </button>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    {{-- Left Column --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Order Info --}}
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 hover-lift slide-in">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Order Information</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Code:</span>
                        <span class="font-medium">{{ $order->id ? "ORD-".str_pad($order->id,6,"0",STR_PAD_LEFT) : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Placed At:</span>
                        <span class="font-medium">{{ $order->created_at?->format('Y-m-d H:i') ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Amount:</span>
                        <span class="font-medium text-blue-600">Rs{{ $order->total ?? '0.00' }}</span>
                    </div>
                    @if(request()->ip())
                    <div class="flex justify-between">
                        <span class="text-gray-600">IP Address:</span>
                        <span class="font-mono text-sm">{{ request()->ip() }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Customer Info --}}
            @if($order->addresses && $order->addresses->count())
            @php $address = $order->addresses->first(); @endphp
            <div class="bg-white rounded-xl shadow-sm p-6 hover-lift slide-in">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Customer Information</h2>
                <div class="space-y-3">
                    @if($address->first_name || $address->last_name)
                    <div>
                        <p class="text-gray-600">Name</p>
                        <p class="font-medium">{{ trim($address->first_name.' '.$address->last_name) }}</p>
                    </div>
                    @endif

                    @if($address->email || $address->phone)
                    <div>
                        <p class="text-gray-600">Contact</p>
                        @if($address->email)<p class="font-medium">{{ $address->email }}</p>@endif
                        @if($address->phone)<p class="font-medium">{{ $address->phone }}</p>@endif
                    </div>
                    @endif

                    @if($address->city)
                    <div>
                        <p class="text-gray-600">City</p>
                        <p class="font-medium">{{ $address->city }}</p>
                    </div>
                    @endif

                    @if($address->address)
                    <div>
                        <p class="text-gray-600">Shipping Address</p>
                        <p class="font-medium">{{ $address->address }}</p>
                        @if($address->city && $address->postal_code)<p class="font-medium">{{ $address->city }}, {{ $address->postal_code }}</p>@endif
                    </div>
                    @endif

                    @if($address->postal_code)
                    <div>
                        <p class="text-gray-600">Postal Code</p>
                        <p class="font-medium">{{ $address->postal_code }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

      {{-- Order Items --}}
@if($order->items && $order->items->count())
<div class="bg-white rounded-xl shadow-sm p-6 hover-lift">
    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
        Order Items ({{ $order->items->count() }})
    </h2>

    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm">
                <tr>
                    <th class="p-3 font-medium">Product</th>
                    <th class="p-3 font-medium">Price</th>
                    <th class="p-3 font-medium">Qty</th>
                    <th class="p-3 font-medium">Total</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach($order->items as $item)
                <tr class="hover:bg-gray-50 transition-colors">

                    {{-- Product Image + Name --}}
                    <td class="p-3">
                        <div class="flex items-center gap-3">

                            {{-- Default Product Image --}}
                            @php
                                $img = $item->product->defaultImage->image ?? null;
                            @endphp

                            @if($img)
                                <img 
                                    src="{{ asset('storage/app/public/' . $img) }}" 
                                    alt="{{ $item->product->name }}" 
                                    class="w-12 h-12 rounded-md object-cover border"
                                >
                            @else
                                <div class="w-12 h-12 rounded-md bg-gray-200 flex items-center justify-center text-xs text-gray-500">
                                    No Img
                                </div>
                            @endif

                            {{-- Product Name --}}
                            <span class="font-medium text-gray-800">
                                {{ $item->product->name }}
                            </span>
                        </div>
                    </td>

                    <td class="p-3">Rs{{ $item->price }}</td>
                    <td class="p-3">{{ $item->quantity }}</td>
                    <td class="p-3">Rs{{ $item->total }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

    </div>

    {{-- Right Column --}}
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6 hover-lift">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Payment & Shipping</h2>
            <div class="space-y-4">
                @if($order->payment_method)
                <div>
                    <p class="text-gray-600 text-sm">Payment Method</p>
                    <p class="font-medium">{{ $order->payment_method }}</p>
                </div>
                @endif
                @if($order->shipping)
                <div>
                    <p class="text-gray-600 text-sm">Shipping</p>
                    <p class="font-medium">Rs{{ $order->shipping }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift sticky top-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Order Summary</h2>
            <div class="space-y-4">
                @if($order->subtotal)
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Subtotal</span>
                    <span class="font-semibold text-gray-800">Rs{{ $order->subtotal }}</span>
                </div>
                @endif

                @if($order->tax)
                <div class="flex justify-between items-center bg-red-50 px-3 py-2 rounded-md">
                    <span class="text-red-600 font-medium">Tax</span>
                    <span class="text-red-600 font-semibold">Rs{{ $order->tax }}</span>
                </div>
                @endif

                @if($order->shipping)
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Shipping</span>
                    <span class="font-semibold text-gray-800">Rs{{ $order->shipping }}</span>
                </div>
                @endif

                @if($order->total)
                <div class="border-t mt-4 pt-4 flex justify-between items-center text-lg font-bold text-gray-800">
                    <span>Grand Total</span>
                    <span>Rs{{ $order->total }}</span>
                </div>
                @endif

           
            </div>
        </div>
    </div>
</div>
</div>
</main>
    </div>
</div>
@endsection

@push("script")
<!-- Add Alpine (defer so it doesn't block) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>    


</script>
@endpush