@extends('user.layouts.master-layouts.plain')

@section('title', 'Order Confirmation')

@section('content')
<div class="container mx-auto my-10">
    <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">
        <!-- Success Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-green-600 mb-2">🎉 Thank You! Your Order is Confirmed</h2>
            <p class="text-gray-600 text-lg">Your order <strong>#{{ $order->id }}</strong> has been successfully placed.</p>
        </div>

        <!-- Order Details -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4 border-b pb-2">Order Details</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 border-b">Product</th>
                            <th class="p-3 border-b">Size</th>
                            <th class="p-3 border-b">Qty</th>
                            <th class="p-3 border-b">Price</th>
                            <th class="p-3 border-b">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-3 border-b">{{ $item->product->name ?? 'N/A' }}</td>
                            <td class="p-3 border-b">{{ $item->size ?? '-' }}</td>
                            <td class="p-3 border-b">{{ $item->quantity }}</td>
                            <td class="p-3 border-b">Rs {{ number_format($item->price, 0) }}</td>
                            <td class="p-3 border-b">Rs {{ number_format($item->price * $item->quantity, 0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Totals -->
        <div class="mb-8 text-right space-y-1">
            <p><strong>Subtotal:</strong> Rs {{ number_format($order->subtotal, 0) }}</p>
            <p><strong>Shipping:</strong> Rs {{ number_format($order->shipping, 0) }}</p>
            <p><strong>Discount:</strong> Rs {{ number_format($order->discount, 0) }}</p>
            <p class="text-2xl font-bold mt-2">Total: Rs {{ number_format($order->total, 0) }}</p>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row justify-between gap-4">
            <a href="{{ route('product') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg font-semibold transition">
                🛍️ Continue Shopping
            </a>
            <a id="download-invoice" href="{{ route('order.invoice.download', $order->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                ⬇️ Download Invoice
            </a>
        </div>
    </div>
</div>

<!-- Auto-download invoice on page load -->
@section('scripts')
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const link = document.getElementById('download-invoice');
        if(link){
            // Trigger automatic download
            window.location.href = link.href;
        }
    });
</script>
@endsection
