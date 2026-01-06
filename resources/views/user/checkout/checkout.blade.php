@extends('user.layouts.master-layouts.plain')
    <title>Grocery Station One (GSO) - Checkout</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @push('style')
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-hover);
        }
        
        /* Form styling */
        .form-input {
            @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)] focus:border-transparent;
        }
        
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-1;
        }
    </style>
    @endpush


    @section('content')
    
<div class="bg-gray-50">


    <!-- Checkout Section -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-[var(--primary-color)] mb-2">Checkout</h1>
            <p class="text-gray-600 mb-6">Complete your purchase with secure checkout</p>
            
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Checkout Form -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Form Header -->
                        <div class="bg-[var(--primary-color)]/10 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-[var(--primary-color)]">Shipping & Billing Information</h2>
                        </div>
                        
                        <!-- Form Content -->
                        <form action="{{ route('checkout.placeOrder') }}" method="POST" class="p-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
            <input type="text" name="first_name" required 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
            <input type="text" name="last_name" required 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" name="email" required 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
            <input type="text" name="address" required 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
            <input type="text" name="city" required 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">ZIP / Postal Code</label>
            <input type="text" name="postal_code" value="0000" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" name="phone" required 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)]">
        </div>
    </div>

    <div class="mt-6">
        <input type="hidden" name="payment_method" value="cod">
        <button type="submit" class="mt-6 w-full bg-[var(--primary-color)] text-[var(--text-on-primary)] font-bold py-3 px-4 rounded-lg hover:bg-[var(--primary-hover)] transition">
            Place Order
        </button>
    </div>
<!-- Same as shipping address checkbox -->

    <!-- Same Billing Checkbox -->
    <div class="mt-6 flex items-center">
    <input type="hidden" name="same_billing" value="0">
<input 
    type="checkbox" 
    id="same-billing" 
    name="same_billing" 
    value="1" 
    checked
    class="h-4 w-4 text-[var(--accent-color)] focus:ring-[var(--accent-color)] border-gray-300 rounded"
/>

        <label for="same-billing" class="ml-2 block text-sm text-gray-700">
            Billing address is the same as shipping address
        </label>
    </div>

    <!-- Billing Address Fields -->
    <div id="billing-fields" class="hidden mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Billing First Name</label>
                <input type="text" name="billing_first_name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Billing Last Name</label>
                <input type="text" name="billing_last_name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                <input type="text" name="billing_address" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Billing City</label>
                <input type="text" name="billing_city" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Billing Phone</label>
                <input type="text" name="billing_phone" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm" />
            </div>
        </div>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sameBilling = document.getElementById('same-billing');
    const billingSection = document.getElementById('billing-fields');

    const toggleBillingFields = () => {
        if (sameBilling.checked) {
            billingSection.classList.add('hidden');
        } else {
            billingSection.classList.remove('hidden');
        }
    };

    sameBilling.addEventListener('change', toggleBillingFields);
    toggleBillingFields();
});
</script>
              
                            <!-- Payment Method -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-[var(--primary-color)] mb-4">Payment Method</h3>
                                
                                <div class="space-y-4">
                                    <!-- Cash on Delivery -->
                                    <div>
                                        <input type="radio" id="cod" name="payment" value="cod" class="payment-radio hidden" checked>
                                        <label for="cod" class="payment-label flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer">
                                            <div class="flex items-center justify-center h-5 w-5 rounded-full border border-gray-300 mr-3">
                                                <div class="h-3 w-3 rounded-full bg-[var(--accent-color)] hidden"></div>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-money-bill-wave text-[var(--accent-color)] text-xl mr-3"></i>
                                                <div>
                                                    <span class="font-medium text-gray-900">Cash on Delivery</span>
                                                    <p class="text-sm text-gray-500">Pay when you receive your order</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <!-- Online Payment -->
                                    {{-- <div>
                                        <input type="radio" id="online" name="payment" value="online" class="payment-radio hidden">
                                        <label for="online" class="payment-label flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer">
                                            <div disabled class="flex items-center justify-center h-5 w-5 rounded-full border border-gray-300 mr-3">
                                                <div class="h-3 w-3 rounded-full bg-[var(--accent-color)] hidden"></div>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-credit-card text-[var(--accent-color)] text-xl mr-3"></i>
                                                <div>
                                                    <span class="font-medium text-gray-900">Online Payment</span>
                                                    <p class="text-sm text-gray-500">Pay securely with your card or digital wallet</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div> --}}
                                </div>
                                
                                <!-- Online Payment Button (shown only when online payment is selected) -->
                                <div id="online-payment-btn" class="mt-6 hidden">
                                    <button type="button" id="redirect-payment" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition flex items-center justify-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Proceed to Secure Payment
                                    </button>
                                    <p class="text-xs text-gray-500 mt-2 text-center">You will be redirected to our secure payment partner</p>
                                </div>
                            </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                   
                </div>
                
                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-[var(--primary-color)] mb-4">Order Summary</h2>
                        
                     
                        
                        <!-- Order Totals -->
                   <!-- Order Items -->
<div class="space-y-4 mb-6">
@foreach($cartItems as $item)
    @php
        $product = $item->product;
        $price = $item->price ?? $product->price ?? 0;
        $name = $item->name ?? $product->name;
        $image = $product->default_image->image_path 
            ?? ($product->images->first()->image_path ?? null);
    @endphp

    <div class="flex items-center">
        <div class="w-12 h-12 bg-[var(--primary-color)]/10 rounded-lg flex items-center justify-center mr-3">
            @if($image)
                <img src="{{ asset('storage/app/public/' . $image) }}" 
                     alt="{{ $name }}" 
                     class="h-10 w-10 object-cover rounded">
            @endif
            </div>
            <div class="flex-grow">
                <h3 class="font-medium text-gray-800 text-sm">{{ $name }}</h3>
                <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                @if($item->size)
                    <p class="text-xs text-gray-500">Size: {{ $item->size }}</p>
                @endif
            </div>
            <span class="font-medium text-[var(--accent-color)]">PKR.{{ number_format($price * $item->quantity, 2) }}</span>
        </div>
    @endforeach
</div>

@php
use App\Models\Sale;
use Carbon\Carbon;

// Find active sale
$now = Carbon::now();
$activeSale = Sale::where('starts_at', '<=', $now)
    ->where('ends_at', '>=', $now)
    ->first();

// Cart base totals
$subtotal = $cartItems->sum(fn($c) => ($c->price ?? $c->product->price ?? 0) * $c->quantity);
$shipping =  250; // if you use fixed shipping
$tax = $tax ?? 0;

// Apply discount if sale is active
$discountPercent = $activeSale ? $activeSale->discount_percent : 0;
$discountAmount = ($subtotal * $discountPercent) / 100;
$grandTotal = $subtotal - $discountAmount + $shipping + $tax;
@endphp

  

<div class="space-y-3 mb-6 border-t border-gray-200 pt-4">
    <div class="flex justify-between">
        <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
        <span class="font-medium">PKR. {{ number_format($subtotal, 2) }}</span>
    </div>

    @if($activeSale)
        <div class="flex justify-between text-[var(--accent-color)]">
            <span>Sale Discount ({{ $activeSale->discount_percent }}%)</span>
            <span>-PKR. {{ number_format($discountAmount, 2) }}</span>
        </div>
    @endif

    <div class="flex justify-between">
        <span class="text-gray-600">Shipping</span>
        <span class="font-medium">PKR. {{ number_format($shipping, 2) }}</span>
    </div>

    <div class="flex justify-between">
        <span class="text-gray-600">Tax</span>
        <span class="font-medium">PKR. {{ number_format($tax, 2) }}</span>
    </div>

    <div class="border-t border-gray-200 pt-3">
        <div class="flex justify-between">
            <span class="text-lg font-bold text-[var(--primary-color)]">Total</span>
            <span class="text-lg font-bold text-[var(--accent-color)]">
                PKR. {{ number_format($grandTotal, 2) }}
            </span>
        </div>
    </div>
</div>




                        
                        <!-- Delivery Info -->
                        <div class="bg-[var(--primary-color)]/10 rounded-lg p-4 mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-truck text-[var(--primary-color)] mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-[var(--primary-color)]">Estimated Delivery</h4>
                                    <!-- <p class="text-sm text-[var(--primary-color)]">Tomorrow, 2:00 PM - 5:00 PM</p> -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Security Note -->
                        <div class="text-center text-sm text-gray-500">
                            <i class="fas fa-shield-alt mr-1"></i> Secure checkout guaranteed
                        </div>
                    </div>
                    
                    <!-- Support Info -->
                    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                        <h3 class="font-semibold text-[var(--primary-color)] mb-2">Need Help?</h3>
                        <p class="text-sm text-gray-600 mb-4">Our customer service team is available to assist you with any questions.</p>
                        <div class="flex items-center text-[var(--primary-color)]">
                            <i class="fas fa-phone-alt mr-2"></i>
                            <span><a href="tel:+9231892770">+923189270460</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>


    @endsection
    

@push('script')
    <script>
        document.querySelectorAll('.payment-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.payment-label').forEach(label => {
                    const radioBtn = label.previousElementSibling;
                    const indicator = label.querySelector('.h-3.w-3');
                    
                    if (radioBtn.checked) {
                        label.classList.add('border-[var(--accent-color)]', 'bg-[var(--accent-color)]/10');
                        indicator.classList.remove('hidden');
                    } else {
                        label.classList.remove('border-[var(--accent-color)]', 'bg-[var(--accent-color)]/10');
                        indicator.classList.add('hidden');
                    }
                });
      
                const onlinePaymentBtn = document.getElementById('online-payment-btn');
                if (this.value === 'online') {
                    onlinePaymentBtn.classList.remove('hidden');
                    document.getElementById('place-order-btn').classList.add('hidden');
                } else {
                    onlinePaymentBtn.classList.add('hidden');
                    document.getElementById('place-order-btn').classList.remove('hidden');
                }
            });
        });
        
        document.getElementById('cod').dispatchEvent(new Event('change'));
        
        document.getElementById('redirect-payment').addEventListener('click', function() {
            alert('Redirecting to secure payment gateway...');
        });
        
        document.getElementById('place-order-btn').addEventListener('click', function(e) {
            e.preventDefault();
            
            const requiredFields = document.querySelectorAll('input[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            
            if (isValid) {
                alert('Your order has been placed successfully! You will receive a confirmation email shortly.');
            } else {
                alert('Please fill in all required fields.');
            }
        });
        

    </script>
@endpush