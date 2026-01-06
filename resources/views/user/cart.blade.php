@extends("user.layouts.master-layouts.plain")
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Grocery Station One | Cart </title>

@push("script")
@endpush


@push("style")
<style>
    

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-hover);
        }
    </style>
@endpush


@section("content")
<div class="bg-gray-50">
    

    <!-- Cart Section -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-[var(--primary-color)] mb-2">Your Shopping Cart</h1>
            <p class="text-gray-600 mb-6">Review your items and proceed to checkout</p>
            
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Cart Header -->
                        <div class="bg-[var(--primary-color)]/10 px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                            @php
                use App\Models\Cart;
                use Illuminate\Support\Facades\Auth;
                if (Auth::check()) {
                    $cartCount = Cart::where('user_id', Auth::id())->count();
                } else {
                    $guestToken = session('guest_token');
                    $cartCount = Cart::where('guest_token', $guestToken)->count();
                }
            @endphp
                                <h2 class="text-lg font-semibold text-[var(--primary-color)]">Total Item {{  $cartCount }}</h2>
                             
                            </div>
                        </div>
                        
                        <!-- Cart Items List -->
                        <div class="divide-y divide-gray-200">
                        @forelse($cartItems as $cart)
    @php
        $product = $cart->product;
        $image = $product->default_image ?? null;
        $totalPrice = $cart->quantity * $cart->price;
    @endphp

    <div class="cart-item p-6 flex flex-col md:flex-row gap-4" data-price="{{ $cart->price }}">
        <div class="md:w-24 md:h-24 flex-shrink-0 bg-[var(--primary-color)]/10 rounded-lg flex items-center justify-center">
            @if($image)
                <img src="{{ asset('storage/app/public/' . $image->image_path) }}" 
                     alt="{{ $product->name }}" 
                     class="h-20 w-20 object-cover rounded">
            @else
                <span class="text-gray-400 text-sm">No Image</span>
            @endif
        </div>

        <div class="flex-grow">
            <div class="flex justify-between">
                <h3 class="font-semibold text-[var(--primary-color)]">{{ $product->name }}</h3>
                <span class="font-bold text-[var(--accent-color)]">PKR. {{ number_format($cart->price, 2) }}</span>
            </div>

            @if($cart->size)
    
            <p class="text-gray-600 text-sm mt-1">Size: {{ $cart->size * 1000 }}G</p>
            @endif

            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center border border-gray-300 rounded-lg">
                    <button class="quantity-btn decrease-qty w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-100" data-id="{{ $cart->id }}">
                        <i class="fas fa-minus"></i>
                    </button>
                    <span class="quantity-display w-10 text-center font-medium">{{ $cart->quantity }}</span>
                    <button class="quantity-btn increase-qty w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-100" data-id="{{ $cart->id }}">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="font-semibold text-[var(--accent-color)] item-total">PKR. {{ number_format($totalPrice, 2) }}</span>
                    <button class="text-red-500 hover:text-red-700 remove-item" data-id="{{ $cart->id }}">
    <i class="fas fa-trash-alt"></i>
</button>

                </div>
            </div>
        </div>
    </div>
@empty
    <div class="p-6 text-center text-gray-600">
        Your cart is empty 😢
    </div>
@endforelse

</div>

                        
                        <!-- Continue Shopping -->
                        <div class="p-6 bg-gray-50 border-t border-gray-200">
                            <a href="{{ route('product') }}" class="inline-flex items-center text-[var(--primary-color)] hover:text-[var(--primary-hover)] font-medium">
                                <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
              <!-- Order Summary -->
<div class="lg:w-1/3" id="order-summary">
    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
        <h2 class="text-xl font-bold text-[var(--primary-color)] mb-4">Order Summary</h2>
@php
    $subtotal = $cartItems->sum(fn($c) => $c->price * $c->quantity);
    $shipping = 250;
    $discountAmount = 0;

    if (isset($activeSale)) {
        $discountAmount = ($subtotal * $activeSale->discount_percent) / 100;
    }

    $grandTotal = $subtotal - $discountAmount + $shipping;
@endphp
<div class="space-y-3 mb-6">
    <div class="flex justify-between">
        <span class="text-gray-600">
            Subtotal (<span id="total-items">{{ $cartItems->sum('quantity') }}</span> items)
        </span>
        <span class="font-medium">PKR <span id="subtotal">{{ number_format($subtotal, 2) }}</span></span>
    </div>

    @if(isset($activeSale))
        <div id="sale-discount" class="flex justify-between text-[var(--accent-color)] font-medium" 
             data-percent="{{ $activeSale->discount_percent }}">
            <span>Sale Discount ({{ $activeSale->discount_percent }}%)</span>
            <span>-PKR <span id="discount-amount">{{ number_format($discountAmount, 2) }}</span></span>
        </div>
    @endif

    <div class="flex justify-between">
        <span class="text-gray-600">Shipping</span>
        <span class="font-medium">PKR <span id="shipping">{{ number_format($shipping, 2) }}</span></span>
    </div>

    <div class="flex justify-between">
        <span class="text-gray-600">Tax</span>
        <span class="font-medium">PKR <span id="tax">0.00</span></span>
    </div>

    <div class="border-t border-gray-200 pt-3">
        <div class="flex justify-between">
            <span class="text-lg font-bold text-[var(--primary-color)]">Total</span>
            <span class="text-lg font-bold text-[var(--accent-color)]">
                PKR <span id="grand-total">{{ number_format($grandTotal, 2) }}</span>
            </span>
        </div>
    </div>
</div>



        <a href="{{ route('checkout.index') }}" class="w-full bg-[var(--primary-color)] text-[var(--text-on-primary)] font-bold py-3 px-4 rounded-lg hover:bg-[var(--primary-hover)] transition flex items-center justify-center">
            <i class="fas fa-lock mr-2"></i> Proceed to Checkout
    </a>

        <div class="mt-4 text-center text-sm text-gray-500">
            <i class="fas fa-shield-alt mr-1"></i> Secure checkout guaranteed
        </div>
    </div>
</div>

            </div>
        </div>
    </section>
@endsection


@push("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

// Increase or Decrease Quantity
$('.increase-qty, .decrease-qty').click(function(e) {
    e.preventDefault();

    const button = $(this);
    const id = button.data('id');
    const action = button.hasClass('increase-qty') ? 'increase' : 'decrease';
    const item = button.closest('.cart-item');
    const quantityDisplay = item.find('.quantity-display');
    const totalElement = item.find('.item-total');
    const unitPrice = parseFloat(item.data('price'));

    let quantity = parseInt(quantityDisplay.text());

    // Update visually before backend
    if (action === 'increase') quantity++;
    else if (action === 'decrease' && quantity > 1) quantity--;

    quantityDisplay.text(quantity);
    totalElement.text(`$${(quantity * unitPrice).toFixed(2)}`);

    // Send AJAX to backend
    $.ajax({
        url: `/cart/update/${id}`,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            action: action
        },
        success: function(res) {
            updateCartSummary();
        },
        error: function() {
            alert('Error updating cart');
        }
    });
});
function updateCartSummary() {
    let subtotal = 0;
    let totalItems = 0;

    // Loop through all cart items
    $('.cart-item').each(function() {
        const price = parseFloat($(this).data('price'));
        const quantity = parseInt($(this).find('.quantity-display').text());
        subtotal += price * quantity;
        totalItems += quantity;
    });

    const shipping = 250;
    const tax = 0;

    const discountPercent = parseFloat($('#sale-discount').data('percent')) || 0;
    const discountAmount = (subtotal * discountPercent) / 100;

    const grandTotal = subtotal - discountAmount + shipping + tax;

    $('#subtotal').text(subtotal.toFixed(2));
    $('#total-items').text(totalItems);

    if (discountPercent > 0) {
        $('#sale-discount').show();
        $('#discount-amount').text(discountAmount.toFixed(2));
    } else {
        $('#sale-discount').hide();
    }

    $('#grand-total').text(grandTotal.toFixed(2));
}


function updateQuantity(id, action, button) {
    const itemRow = button.closest('.cart-item');
    const quantityDisplay = itemRow.find('.quantity-display');
    const totalElement = itemRow.find('.item-total');
    const unitPrice = parseFloat(itemRow.data('price'));
    
    let quantity = parseInt(quantityDisplay.text());

    if (action === 'increase') quantity++;
    else if (action === 'decrease' && quantity > 1) quantity--;

    quantityDisplay.text(quantity);
    totalElement.text(`PKR ${(quantity * unitPrice).toFixed(2)}`);

    $.ajax({
        url: `/cart/update/${id}`,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            action: action,
            guest_token: getGuestToken(),
        },
        xhrFields: { withCredentials: true },
        success: function (res) {
            if (res.success) {
                // Update summary after backend confirms
                recalculateCartSummary();
            }
        },
        error: function () {
            alert(' Error updating cart quantity.');
        }
    });
}


function getGuestToken() {
    const name = "guest_token=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookies = decodedCookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let c = cookies[i].trim();
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}

$(document).on('click', '.remove-item', function(e) {
    e.preventDefault();

    const button = $(this);
    const cartId = button.data('id');

    if (confirm('Are you sure you want to remove this item from your cart?')) {
        $.ajax({
            url: `/cart/remove/${cartId}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Remove item from UI
                button.closest('.cart-item').remove();

                const cartCount = $('.absolute.bg-yellow-400');
                let count = parseInt(cartCount.text());
                cartCount.text(count > 0 ? count - 1 : 0);

                updateCartSummary();

                Swal.fire('Removed!', 'Item removed from your cart.', 'success');
            },
            error: function(err) {
                console.error('Error removing item:', err);
                Swal.fire('Error', 'Failed to remove item.', 'error');
            }
        });
    }
});
});
    </script>
@endpush