<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Placed</title>
    <style>
        body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f1f5f9; }
        table, td { border-collapse: collapse; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        @media only screen and (max-width: 600px) {
            .mobile-padding { padding: 20px !important; }
            .mobile-stack { display: block !important; width: 100% !important; }
            .mobile-center { text-align: center !important; }
            .mobile-hide { display: none !important; }
        }
    </style>
</head>
<body>

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f1f5f9;">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); padding: 40px 20px;">
                            <div style="background-color: rgba(255,255,255,0.2); width: 64px; height: 64px; border-radius: 50%; display: inline-block; line-height: 64px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.3);">
                                <span style="font-size: 32px; color: #ffffff;">&#128230;</span>
                            </div>
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 800;">New Order Placed</h1>
                            <p style="color: #e0e7ff; margin: 8px 0 0 0; font-size: 16px;">Order #{{ $order->id }} has been placed</p>
                        </td>
                    </tr>

                    <!-- Customer Info -->
                    <tr>
                        <td class="mobile-padding" style="padding: 40px 40px 20px 40px;">
                            @foreach ($order->addresses as $address)
                                <h2 style="color: #1e293b; margin: 0 0 10px 0; font-size: 18px; font-weight: 700;">Customer: {{ $address->first_name ?? 'N/A' }} {{ $address->last_name ?? '' }}</h2>
                                <p style="margin: 0; font-size: 14px; color: #64748b; line-height: 24px;">
                                    Email: {{ $address->email ?? 'N/A' }}<br>
                                    Phone: {{ $address->phone ?? 'N/A' }}<br>
                                    Address: {{ $address->address ?? 'N/A' }}, {{ $address->city ?? '' }}, {{ $address->state ?? '' }}, {{ $address->postal_code ?? '' }}
                                </p>
                            @break
                            @endforeach
                        </td>
                    </tr>

                    <!-- Order Details -->
                    <tr>
                        <td class="mobile-padding" style="padding: 0 40px 30px 40px;">
                            <table width="100%" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px;">
                                <tr>
                                    <td>
                                        <p style="margin: 0 0 5px 0; font-size: 12px; font-weight: bold; color: #4f46e5;">Order Number:</p>
                                        <p style="margin: 0 0 10px 0; font-size: 14px; font-weight: 600; color: #334155;">#{{ $order->id }}</p>

                                        <p style="margin: 0 0 5px 0; font-size: 12px; font-weight: bold; color: #4f46e5;">Date:</p>
                                        <p style="margin: 0 0 10px 0; font-size: 14px; font-weight: 600; color: #334155;">{{ $order->created_at->format('M d, Y H:i') }}</p>

                                        <p style="margin: 0 0 5px 0; font-size: 12px; font-weight: bold; color: #4f46e5;">Payment Method:</p>
                                        <p style="margin: 0 0 10px 0; font-size: 14px; font-weight: 600; color: #334155;">{{ strtoupper($order->payment_method ?? 'N/A') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Order Items -->
                    <tr>
                        <td class="mobile-padding" style="padding: 0 40px 20px 40px;">
                            <h3 style="color: #1e293b; font-size: 16px; font-weight: 700; margin: 0 0 10px 0;">Items Ordered</h3>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                @foreach($order->items as $item)
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="70" valign="top">
                                                    <img src="{{ $item->product->default_image ?? 'https://via.placeholder.com/64' }}" alt="{{ $item->product->name }}" width="64" height="64" style="border-radius: 8px; object-fit: cover;">
                                                </td>
                                                <td style="padding-left: 15px; vertical-align: top;">
                                                    <p style="margin: 0; font-size: 14px; font-weight: 700; color: #1e293b;">{{ $item->product->name }}</p>
                                                    <p style="margin: 2px 0 0 0; font-size: 13px; color: #64748b;">{{ $item->product->description ?? '' }}</p>
                                                    <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b;">Qty: {{ $item->quantity }}</p>
                                                </td>
                                                <td align="right" valign="top" style="white-space: nowrap;">
                                                    <p style="margin: 0; font-size: 14px; font-weight: 700; color: #1e293b;">Rs {{ number_format($item->price, 2) }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    <!-- Total Summary -->
                    <tr>
                        <td class="mobile-padding" style="padding: 0 40px 20px 40px;">
                            <table width="100%" style="background-color: #f8fafc; border-radius: 8px; padding: 15px;">
                                <tr>
                                    <td style="color: #64748b; font-size: 14px;">Subtotal</td>
                                    <td align="right" style="color: #1e293b; font-weight: 600;">Rs {{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-size: 14px;">Shipping</td>
                                    <td align="right" style="color: #1e293b; font-weight: 600;">Rs {{ number_format($order->shipping, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-size: 14px;">Taxes</td>
                                    <td align="right" style="color: #1e293b; font-weight: 600;">Rs {{ number_format($order->tax, 2) }}</td>
                                </tr>
                                @if($order->discount > 0)
                                <tr>
                                    <td style="color: #059669; font-size: 14px;">Discount</td>
                                    <td align="right" style="color: #059669; font-weight: 600;">- Rs {{ number_format($order->discount, 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="2" style="border-top: 1px solid #e2e8f0; padding-top: 10px; font-size: 16px; font-weight: 700; color: #1e293b;">Total</td>
                                    <td align="right" style="padding-top: 10px; font-size: 16px; font-weight: 700; color: #4f46e5;">Rs {{ number_format($order->total, 2) }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px 40px 40px 40px; border-top: 1px solid #f1f5f9;">
                            <p style="margin: 0; color: #64748b; font-size: 12px;">This email contains order details. Do not reply.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
