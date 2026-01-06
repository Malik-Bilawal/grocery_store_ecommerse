@extends("user.layouts.master-layouts.plain")
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Grocery Station One | Product Detail </title>

@push("script")
@endpush


@push("style")
<style>

        .image-gallery img {
            transition: transform 0.3s ease;
        }
        
        .image-gallery img:hover {
            transform: scale(1.05);
        }
        
        .weight-option {
            transition: all 0.2s ease;
        }
        
        .weight-option.selected {
            border-color: #16a34a;
            background-color: #f0fdf4;
        }
        
        .quantity-btn {
            transition: background-color 0.2s ease;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .tab-button.active {
            border-bottom: 3px solid #16a34a;
            color: #16a34a;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #16a34a;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #15803d;
        }

</style>
@endpush
@section("content")

<!-- Breadcrumb -->
<div class="container mx-auto px-4 py-4">
    <nav class="text-sm text-gray-600">
        <a href="index.html" class="hover:text-[var(--accent-hover)]">Home</a>
        <span class="mx-2">/</span>
        <a href="#" class="hover:text-[var(--accent-hover)]">Rice & Grains</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">Premium Basmati Rice</span>
    </nav>
</div>

<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Images -->
            <div class="md:w-1/2">
                <div class="mb-4 bg-white rounded-lg shadow-sm p-4">
                    <img id="main-image" 
                         src="{{ asset('storage/app/public/' . ($product->images->where('is_default',1)->first()->image_path ?? $product->images->first()->image_path ?? 'placeholder.png')) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-80 object-cover rounded-lg">
                </div>

                <div class="image-gallery grid grid-cols-4 gap-2">
                    @foreach($product->images as $img)
                        <div class="cursor-pointer border-2 border-transparent hover:border-[var(--accent-color)] rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/app/public/' . $img->image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-20 object-cover"
                                 onclick="document.getElementById('main-image').src='{{ asset('storage/app/public/' . $img->image_path) }}'">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Details -->
            <div class="md:w-1/2">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <!-- Badge -->
                    @if($product->badge_text)
                        <div class="mb-4">
                            <span class="{{ $product->badge_bg ?? 'bg-[var(--secondary-color)]' }} {{ $product->badge_text_color ?? 'text-[var(--text-on-secondary)]' }} text-xs font-bold px-2 py-1 rounded">
                                {{ $product->badge_text }}
                            </span>
                        </div>
                    @endif

                    <!-- Product Title -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <div class="flex text-[var(--secondary-color)]">
                            @for ($i = 1; $i <= 5; $i++)
                                @if($i <= floor($product->rating ?? 5))
                                    <i class="fas fa-star"></i>
                                @elseif($i - $product->rating < 1)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-gray-500 text-sm ml-2">({{ $product->rating ?? 5 }}) | {{ $product->reviews_count ?? 0 }} Reviews</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <span class="text-2xl font-bold text-[var(--accent-color)]" id="product-price">
                            PKR.{{ $product->offer_price ?? $product->price }}
                        </span>
                        @if($product->offer_price)
                            <span class="text-gray-500 text-sm line-through ml-2">Rs{{ $product->price }}</span>
                            {{-- <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded ml-2">
                                {{ round((($product->price - $product->offer_price)/$product->price)*100) }}% OFF
                            </span> --}}
                                               @if($product->offer_price && !empty($product->price) && $product->price > 0)
    @php
        $discount = round((($product->price - $product->offer_price) / $product->price) * 100);
    @endphp
    <span class="text-[var(--secondary-color)] text-xs font-bold bg-[var(--secondary-color)]/10 px-2 py-1 rounded-full">
        {{ $discount }}% OFF
    </span>
@endif
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <p class="text-gray-700">{{ $product->description }}</p>
                    </div>



                                     <!-- Weight Options -->
<!-- Weight Options -->
@if($product->sizes->count())
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Select Weight:</h3>
        <div class="flex flex-wrap gap-3" id="weight-options">
            @foreach($product->sizes as $weight)
                @php
                    // Convert KG to grams
                    $grams = $weight->size * 1000;
                @endphp
                <button class="weight-btn luxury-btn-primary border px-4 py-2 rounded-full transition-all hover:scale-105"
                        data-size="{{ $weight->size }}"
                        data-price="{{ $weight->price }}">
                    {{ $grams }} G
                </button>
            @endforeach
        </div>
    </div>
@endif

                    <!-- Quantity -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Quantity:</h3>
                        <div class="flex items-center">
                            <button id="decrease-qty" class="quantity-btn bg-gray-200 text-gray-700 w-10 h-10 rounded-l-lg flex items-center justify-center">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" id="quantity" value="1" min="1" max="10" class="w-16 h-10 text-center border-t border-b border-gray-300">
                            <button id="increase-qty" class="quantity-btn bg-gray-200 text-gray-700 w-10 h-10 rounded-r-lg flex items-center justify-center">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-6">
                        <button id="add-to-cart" 
                                class="flex-1 bg-[var(--accent-color)] text-white py-3 px-6 rounded-lg hover:bg-[var(--accent-hover)] transition flex items-center justify-center"
                                data-product-id="{{ $product->id }}">
                            <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                        </button>

                        <button id="buy-now" 
                                data-product-id="{{ $product->id }}" 
                                data-quantity="1" 
                                class="flex-1 bg-[var(--secondary-color)] text-[var(--text-on-secondary)] font-bold py-3 px-6 rounded-lg hover:bg-[var(--secondary-hover)] transition flex items-center justify-center">
                            <i class="fas fa-bolt mr-2"></i> Buy Now
                        </button>
                    </div>

                    <form id="cartForm" action="{{ route('cart.add') }}" method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="size" id="selectedSize">
                        <input type="hidden" name="quantity" id="selectedQty" value="1">
                    </form>

                    <!-- Additional Info -->
                    <div class="border-t border-gray-200 pt-4">
                        {{-- <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-truck mr-2 text-[var(--accent-color)]"></i>
                            <span>Free delivery on orders over 5000</span>
                        </div> --}}
                        {{-- <div class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-undo mr-2 text-[var(--accent-color)]"></i>
                            <span>30-day return policy</span>
                        </div> --}}
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-shield-alt mr-2 text-[var(--accent-color)]"></i>
                            <span>Quality guaranteed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ratings & Reviews Section -->
        <div class="mt-12 bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-gray-900">Ratings & Reviews</h2>

                @auth
                    <button 
                        class="bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] text-[var(--text-on-primary)] font-medium px-4 py-2 rounded-md"
                        onclick="openReviewModal({{ $product->id }})">
                        Write a Review
                    </button>
                @else
                    <button 
                        class="bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] text-[var(--text-on-primary)] font-medium px-4 py-2 rounded-md"
                        onclick="pleaseLogin()">
                        Write a Review
                    </button>
                @endauth
            </div>

            <div id="review-list" class="space-y-4">
                @forelse($product->reviews as $review)
                    <div class="border-b border-gray-200 pb-3">
                        <div class="flex items-center mb-1">
                            <div class="flex text-[var(--secondary-color)] mr-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->rating ? 'fas fa-star' : 'far fa-star' }}"></i>
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600">{{ $review->user->name }}</span>
                        </div>
                        <p class="text-gray-700 text-sm">{{ $review->comment }}</p>
                        <p class="text-gray-400 text-xs mt-1">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No reviews yet. Be the first to write one!</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 hidden bg-black/40 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded-xl w-full max-w-md">
    <h2 class="text-lg font-semibold mb-4">Leave a Review</h2>

    <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
      @csrf
      <input type="hidden" name="product_id" id="product_id">

      <label class="block mb-2 font-medium">Rating</label>
      <select name="rating" class="w-full border p-2 rounded mb-3" required>
        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
        <option value="4">⭐️⭐️⭐️⭐️</option>
        <option value="3">⭐️⭐️⭐️</option>
        <option value="2">⭐️⭐️</option>
        <option value="1">⭐️</option>
      </select>

      <label class="block mb-2 font-medium">Comment</label>
      <textarea name="comment" class="w-full border p-2 rounded mb-4" rows="3" required></textarea>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeReviewModal()" class="px-3 py-1 bg-gray-300 rounded-md">Cancel</button>
        <button type="submit" class="px-3 py-1 bg-[var(--primary-color)] text-[var(--text-on-primary)] hover:bg-[var(--primary-hover)] rounded-md">Submit</button>
      </div>
    </form>
  </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function pleaseLogin() {
    Swal.fire({
        icon: 'info',
        title: 'Login Required',
        text: 'Please login to leave a review.',
        confirmButtonText: 'Go to Login',
        confirmButtonColor: 'var(--primary-color)',
        background: '#fff',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('login') }}";
        }
    });
}

function openReviewModal(productId) {
    document.getElementById('product_id').value = productId;
    document.getElementById('reviewModal').classList.remove('hidden');
}

function closeReviewModal() {
    document.getElementById('reviewModal').classList.add('hidden');
}


document.addEventListener('DOMContentLoaded', function() {
    $('#reviewForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('reviews.store') }}",
            method: "POST",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank you!',
                        text: response.message,
                        confirmButtonColor: 'var(--primary-color)'
                    });
                    $('#reviewModal').hide();
                    $('#reviewForm')[0].reset();
                    // You can also refresh the review list dynamically later
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please Login',
                        text: 'You must log in to submit a review.',
                        confirmButtonColor: 'var(--primary-color)'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.'
                    });
                }
            }
        });
    });
});
</script>

@endsection



@push("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    let selectedWeight = null;
    let selectedPrice = null;

    
    // Auto-select first weight button if exists
    const firstBtn = $('.weight-btn').first();
    if(firstBtn.length) {
        firstBtn.addClass('bg-green-500 text-white');
        selectedWeight = firstBtn.attr('data-size');
        selectedPrice = parseFloat(firstBtn.attr('data-price'));

        // Update price display with PKR
        $('#product-price').text('PKR.' + selectedPrice.toFixed(2));

        console.log('Auto-selected weight:', selectedWeight, 'Price:', selectedPrice);
    }
    
    // Delegated listener
    $(document).on('click', '.weight-btn', function() {
        $('.weight-btn').removeClass('bg-green-500 text-white');
        $(this).addClass('bg-green-500 text-white');

        selectedWeight = $(this).attr('data-size');
        selectedPrice = parseFloat($(this).attr('data-price')); 

        console.log(' Weight selected:', selectedWeight, 'Price:', selectedPrice);

        // Update price display with PKR
        $('#product-price').text('PKR.' + selectedPrice.toFixed(2));
    });




    // Quantity controls
    $('#increase-qty').click(function() {
        let val = parseInt($('#quantity').val());
        if(val < 10) $('#quantity').val(val + 1);
        console.log('Quantity increased to:', $('#quantity').val());
    });

    $('#decrease-qty').click(function() {
        let val = parseInt($('#quantity').val());
        if(val > 1) $('#quantity').val(val - 1);
        console.log('Quantity decreased to:', $('#quantity').val());
    });

    // Add to Cart
    $('#add-to-cart').click(function(e) {
        e.preventDefault();
        const productId = $(this).data('product-id');
        const quantity = parseInt($('#quantity').val()) || 1;

        console.log('Add to Cart clicked');
        console.log('Selected Weight:', selectedWeight);
        console.log('Selected Price:', selectedPrice);
        console.log('Quantity:', quantity);
        console.log('Product ID:', productId);

        if ($('#weight-options').length && !selectedWeight) {
    Swal.fire({
        title: 'Select Weight/Size',
        text: 'Please select a weight or size before proceeding!',
        icon: 'warning',
        confirmButtonText: 'Okay',
        confirmButtonColor: '#f59e0b', // Tailwind amber/yellow tone
    });
    return;
}


        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productId,
                quantity: quantity,
                size: selectedWeight,
                price: selectedPrice ,      
            },
            success: function(res) {
    console.log('Add to Cart response:', res);

    Swal.fire({
        title: 'Success!',
        text: 'Product added to cart!',
        icon: 'success',
        confirmButtonText: 'Go to Cart',
        confirmButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/cart';
        }
    });
},

error: function(xhr) {
    console.error('Add to Cart error:', xhr.responseText);

    Swal.fire({
        title: 'Oops...',
        text: 'Something went wrong.',
        icon: 'error',
        confirmButtonText: 'Okay',
        confirmButtonColor: '#d33',
    });
}

        });
    });

    // Buy Now
    $('#buy-now').click(function(e) {
        e.preventDefault();
        const productId = $(this).data('product-id');
        const quantity = parseInt($('#quantity').val()) || 1;

        console.log('Buy Now clicked');
        console.log('Selected Weight:', selectedWeight);
        console.log('Selected Price:', selectedPrice);
        console.log('Quantity:', quantity);
        console.log('Product ID:', productId);

        if($('#weight-options').length && !selectedWeight) {
            alert('Please select a weight/size!');
            return;
        }

        $.ajax({
            url: '{{ url("/buy-now") }}',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productId,
                quantity: quantity,
                size: selectedWeight,
                price: selectedPrice
            },
            success: function(res) {
                console.log('Buy Now response:', res);
                if(res.success) {
                    window.location.href = '/checkout?source=buy_now';
                }
            },
            error: function(xhr) {
                console.error(' Buy Now error:', xhr.responseText);
                alert('Something went wrong! Check console for details.');
            }
        });
    });
});

       
        

</script>
@endpush


