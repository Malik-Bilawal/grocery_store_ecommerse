<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Tailwind CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">

        <!-- Header -->
        <div class="bg-gray-900 text-white px-8 py-6">
            <h1 class="text-2xl font-bold">New Order Received 🛍️</h1>
            <p class="text-gray-300 mt-1">A customer placed a new order on {{ config('app.name') }}</p>
        </div>

        <!-- Order Information -->
        <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">📄 Order Details</h2>

            <div class="grid grid-cols-1 gap-2 text-gray-700">
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Total Amount:</strong> Rs {{ number_format($order->total, 2) }}</p>
                <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="px-8 py-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">👤 Customer Information</h2>

            <div class="grid grid-cols-1 gap-2 text-gray-700">
                <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
            </div>
        </div>

        <!-- Action Button -->
        <div class="px-8 py-6 text-center">
            <a href="{{ url('/admin/orders/' . $order->id) }}"
               class="inline-block bg-gray-900 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-black transition">
                View in Admin Panel
            </a>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 text-center text-gray-500 text-sm py-4">
            Keep up the great work 🚀  
            <br>
            — {{ config('app.name') }} Notifications
        </div>

    </div>

</body>
</html>
