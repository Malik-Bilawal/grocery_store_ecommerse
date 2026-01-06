<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background: #f4f4f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            padding: 50px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        h1, h2, h3, h4 {
            margin: 0;
        }

        /* Header */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #00a86b;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .company-info {
            text-align: right;
        }

        .company-info h2 {
            color: #00a86b;
            font-size: 28px;
            font-weight: 700;
        }

        .order-meta {
            margin-bottom: 30px;
        }

        .order-meta h3 {
            font-size: 18px;
            font-weight: 600;
            color: #00a86b;
            margin-bottom: 10px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e2e2;
        }

        th {
            background: #00a86b;
            color: #fff;
            font-weight: 600;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        tbody tr:hover {
            background: #e8f6f1;
        }

        /* Totals */
        .total-section {
            margin-top: 30px;
            text-align: right;
        }

        .total-section table {
            width: 50%;
            float: right;
            border-collapse: collapse;
        }

        .total-section td {
            padding: 10px;
        }

        .grand-total {
            background: #00a86b;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }

        /* Footer */
        .footer {
            clear: both;
            text-align: center;
            margin-top: 60px;
            font-size: 13px;
            color: #777;
            line-height: 1.5;
        }

        /* Logo / Branding (optional) */
        .invoice-logo {
            font-size: 28px;
            font-weight: 700;
            color: #00a86b;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div>
                <h1 class="invoice-logo">Grocery Station One</h1>
                <p><strong>Invoice #{{ $order->id }}</strong></p>
                <p>Date: {{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div class="company-info">
                <h2>Grocery Station one</h2>
                <p>Karachi, Pakistan</p>
                <p> abc@gmail.com</p>
            </div>
        </div>

        <!-- Billing & Shipping -->
        <div class="order-meta">
            <h3>Billing & Shipping Info</h3>
            @php
                $address = $order->addresses->first();
            @endphp
            <p><strong>{{ $address->first_name }} {{ $address->last_name }}</strong></p>
            <p>{{ $address->address }}, {{ $address->city }}</p>
            <p>{{ $address->postal_code }}</p>
            <p>Email: {{ $address->email }}</p>
            <p>Phone: {{ $address->phone }}</p>
        </div>

        <!-- Products Table -->
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Qty</th>
                    <th>Price (PKR)</th>
                    <th>Total (PKR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->size ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="total-section">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td>{{ number_format($order->subtotal, 2) }} PKR</td>
                </tr>
                <tr>
                    <td>Shipping:</td>
                    <td>{{ number_format($order->shipping, 2) }} PKR</td>
                </tr>
                <tr>
                    <td>Discount:</td>
                    <td>-{{ number_format($order->discount, 2) }} PKR</td>
                </tr>
                <tr class="grand-total">
                    <td>Total:</td>
                    <td>{{ number_format($order->total, 2) }} PKR</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for shopping with <strong>GStore</strong>! 🛒</p>
            <p>This is a computer-generated invoice — no signature required.</p>
        </div>
    </div>
</body>
</html>
