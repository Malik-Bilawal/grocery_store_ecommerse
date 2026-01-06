{{-- Load SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tailwindcss.com"></script>

<div class="product-card-container">
    <div class="row"> 
        
        @foreach($products as $product)
            @php
                $defaultImage = $product->images->where('is_default', 1)->first() ?? $product->images->first();
                $hasSizes = $product->sizes->isNotEmpty();
                $initialPriceJs = number_format($product->offer_price ?? $product->price, 2, '.', '');
                $initialPriceView = number_format($product->offer_price ?? $product->price, 2);
            @endphp

            <div class="col-12 col-lg-6 mb-3"> 
                
                <div class="card responsive-product-card shadow-sm border-0 h-100" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $loop->index * 100 }}">
                    
                    <div class="row g-0 h-100">
                        {{-- SECTION A: IMAGE --}}
                        <div class="col-lg-5 col-md-6 bg-light position-relative d-flex flex-column justify-content-between">
                            
                            {{-- Share Button --}}
                            <button class="btn btn-icon share-btn position-absolute top-0 start-0 m-3 z-10 bg-white shadow-sm rounded-circle" 
                                    data-slug="{{ $product->slug }}">
                                <i class="fas fa-share-alt fa-lg" style="color: var(--primary-color);"></i>
                            </button>

                            {{-- Main Image --}}
                            <div class="main-image-wrapper p-3 d-flex align-items-center justify-content-center flex-grow-1">
                                @if($defaultImage)
                                    <img src="{{ asset('storage/app/public/' . $defaultImage->image_path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-fluid main-img">
                                @else
                                    <div class="text-muted small">No Image</div>
                                @endif
                            </div>

                            {{-- Thumbnails --}}
                            @if($product->images->count() > 0)
                                <div class="thumbnail-strip p-2 bg-white border-top">
                                    <div class="d-flex justify-content-center gap-2 overflow-auto no-scrollbar">
                                        @foreach($product->images->take(4) as $image)
                                            <div class="thumb-box rounded border">
                                                <img src="{{ asset('storage/app/public/' . $image->image_path) }}" 
                                                     class="w-100 h-100 object-fit-cover">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- SECTION B: DETAILS --}}
                        <div class="col-lg-7 col-md-6 d-flex flex-column">
                            <div class="card-body p-3">
                                
                                <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap gap-2">
                                    <h2 class="card-title fw-bold mb-0 text-dark fs-5">{{ $product->name }}</h2>
                                    @if($product->rating)
                                        <div class="rating-badge d-flex align-items-center bg-light px-2 py-1 rounded">
                                            <i class="fas fa-star text-warning me-1"></i>
                                            <span class="fw-bold text-dark small">{{ number_format($product->rating, 1) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <p class="text-muted small mb-2 line-clamp-2">
                                    {{ $product->description ?? 'No description available.' }}
                                </p>

                                <div class="price-tag mb-2">
                                    <span class="currency text-muted small">R$</span>
                                    {{-- Class 'dynamic-price' used for visual updates --}}
                                    <span class="amount fw-bold display-6 fs-3 dynamic-price" 
                                          style="color: var(--primary-color);">
                                        {{ $initialPriceView }}
                                    </span>
                                </div>

                                @forelse($product->sizes as $size)
    @php
        // 1. Standardize the key for Config lookup (e.g., 0.37 becomes "0.37")
        $configKey = number_format($size->size, 2, '.', '');
        
        $displaySize = config("product_sizes.map.$configKey");

        if (!$displaySize) {
            $grams = $size->size * 1000;

            $displaySize = ($grams + 0) . 'G';
        }
    @endphp

    <button class="btn btn-outline-secondary btn-sm size-btn" 
            data-price="{{ number_format($size->price, 2, '.', '') }}"
            data-weight="{{ $size->size }}"> 
        {{ $displaySize }}
    </button>
@empty
    <span class="badge bg-secondary opacity-50">One Size</span>
@endforelse
                            </div>

                            <div class="card-footer p-3 border-0 mt-auto bg-transparent">
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <a href="{{ route('product.show', $product->slug) }}" 
                                           class="btn btn-outline-primary w-100 py-2 fw-bold text-uppercase h-100 d-flex align-items-center justify-content-center">
                                            Add to Cart
                                        </a>
                                    </div>
                                    <div class="col-12 col-sm-6">
                            
                                        <button class="btn btn-primary buy-now-btn w-100 py-2 fw-bold text-uppercase h-100 d-flex align-items-center justify-content-center text-white"
                                                data-product-id="{{ $product->id }}"
                                                data-price="{{ $initialPriceJs }}"
                                                data-weight="" 
                                                {{ !$hasSizes ? '' : 'disabled' }}>
                                            Buy Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div> 
</div>

{{-- CSS Styles --}}
<style>
    .responsive-product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; background: #fff; overflow: hidden; }
    .responsive-product-card:hover { transform: translateY(-5px); box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important; }
    .main-image-wrapper { min-height: 200px; background: radial-gradient(circle, #f8f9fa 0%, #e9ecef 100%); }
    @media (min-width: 768px) { .main-image-wrapper { height: 220px; min-height: 100%; } }
    .main-img { max-height: 160px; transition: transform 0.3s ease; }
    @media (min-width: 768px) { .main-img { max-height: 180px; } }
    .responsive-product-card:hover .main-img { transform: scale(1.05); }
    .thumb-box { width: 35px; height: 35px; cursor: pointer; opacity: 0.7; transition: opacity 0.2s; }
    .thumb-box:hover { opacity: 1; border-color: var(--primary-color) !important; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .x-small { font-size: 0.75rem; letter-spacing: 0.5px; }
    .btn-outline-primary { color: var(--primary-color); border-color: var(--primary-color); }
    .btn-outline-primary:hover { background-color: var(--primary-color); color: #fff; }
    .btn-primary { background-color: var(--primary-color); border-color: var(--primary-color); }
    .btn-primary:hover { background-color: var(--primary-hover, #d32f2f); }
    .size-btn { min-width: 35px; }
    .size-btn.active { background-color: var(--primary-color); color: white; border-color: var(--primary-color); }
    .size-btn:hover { border-color: var(--primary-color); color: var(--primary-color); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    document.body.addEventListener('click', function(e) {
        const btn = e.target.closest('.share-btn');
        if (!btn) return;
        e.preventDefault();
        
        const slug = btn.dataset.slug;
        const url = `${window.location.origin}/product/${slug}`;
        const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary-color').trim() || '#000';

        Swal.fire({
            title: '<span class="text-lg font-bold">Share this Product</span>',
            html: `
                <div class="d-flex flex-column gap-3 text-start p-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}" target="_blank" class="btn btn-light d-flex align-items-center gap-2 w-100 justify-content-start text-primary"><i class="fab fa-facebook-f fa-fw"></i> Facebook</a>
                    <a href="https://api.whatsapp.com/send?text=${encodeURIComponent(url)}" target="_blank" class="btn btn-light d-flex align-items-center gap-2 w-100 justify-content-start text-success"><i class="fab fa-whatsapp fa-fw"></i> WhatsApp</a>
                    <button id="copyLinkBtn" class="btn btn-dark d-flex align-items-center gap-2 w-100 justify-content-center mt-2" style="background-color: ${primaryColor}; border:none;"><i class="fas fa-link"></i> Copy Link</button>
                </div>
            `,
            showConfirmButton: false, showCloseButton: true,
            didOpen: () => {
                const copyBtn = document.getElementById('copyLinkBtn');
                if (copyBtn) {
                    copyBtn.addEventListener('click', () => {
                        navigator.clipboard.writeText(url).then(() => {
                            copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                            setTimeout(() => { Swal.close(); }, 1000);
                        });
                    });
                }
            }
        });
    });

    document.body.addEventListener('click', function(e) {
        const sizeBtn = e.target.closest('.size-btn');
        if (!sizeBtn) return;
        e.preventDefault();

        const newPrice = sizeBtn.dataset.price;
        const newWeight = sizeBtn.dataset.weight;

        if(newPrice) {
            const card = sizeBtn.closest('.card');
            
            const priceDisplay = card.querySelector('.dynamic-price');
            if(priceDisplay) priceDisplay.textContent = newPrice;

            const allSizes = card.querySelectorAll('.size-btn');
            allSizes.forEach(btn => btn.classList.remove('active'));
            sizeBtn.classList.add('active');

            const buyNowBtn = card.querySelector('.buy-now-btn');
            if(buyNowBtn) {
                buyNowBtn.dataset.price = newPrice;
                buyNowBtn.dataset.weight = newWeight;
                buyNowBtn.removeAttribute('disabled'); 
            }
        }
    });

    document.body.addEventListener('click', async function(e) {
        const btn = e.target.closest('.buy-now-btn');
        if (!btn) return;
        
        e.preventDefault();

        if(btn.hasAttribute('disabled')) return;

        const productId = btn.dataset.productId;
        const price = btn.dataset.price;
        const weight = btn.dataset.weight;
        const quantity = 1;

        const payload = {
            product_id: productId,
            price: price,
            weight: weight,
            quantity: quantity
        };

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

        try {
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            btn.disabled = true;

            const res = await fetch("{{ url('/buy-now') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            if (res.ok && data.success) {
                window.location.href = "/checkout?source=buy_now";
            } else {
                throw new Error(data.message || 'Error processing request');
            }

        } catch (error) {
            console.error('Buy Now Failed:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message || 'Something went wrong!',
            });
            btn.innerHTML = 'Buy Now';
            btn.disabled = false;
        }

                   btn.innerHTML = 'Buy Now';
            btn.disabled = false;
    });

});
</script>