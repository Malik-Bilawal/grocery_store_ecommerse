@php
// --- SALE LOGIC ---
$activeSale = null;
try {
$activeSale = \App\Models\Sale::where('is_active', 1)
->where(function($q) {
$q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
  })
  ->where(function($q) {
  $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
  })
  ->orderBy('discount_percent', 'desc')
  ->first();
  } catch (\Exception $e) {
  $activeSale = null;
  }

  $basePrice = $product->price;
  $finalPrice = $basePrice;
  $isDiscounted = false;
  $discountTag = '';
  $saleName = '';

  if ($activeSale) {
  $discountPercent = $activeSale->discount_percent;
  $finalPrice = $basePrice - ($basePrice * ($discountPercent / 100));
  $isDiscounted = true;
  $discountTag = '-' . $discountPercent . '%';
  $saleName = $activeSale->name;
  } elseif ($product->offer_price && $product->offer_price > 0 && $product->offer_price < $basePrice) {
    $finalPrice=$product->offer_price;
    $isDiscounted = true;
    $percentOff = round((($basePrice - $finalPrice) / $basePrice) * 100);
    $discountTag = '-' . $percentOff . '%';
    $saleName = 'Sale';
    }

    $rating = $product->rating ?? 0;
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5;
    @endphp

    <div class="group relative w-full bg-white rounded-xl border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-lg flex flex-col h-full">

      <div class="absolute top-3 left-3 z-20 flex flex-col gap-1.5 pointer-events-none">
        @if($isDiscounted)
        <span class="bg-red-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">
          {{ $saleName }} {{ $discountTag }}
        </span>
        @endif
        @if($product->badge_text)
        <span class="bg-gray-900 text-white text-[11px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">
          {{ $product->badge_text }}
        </span>
        @endif
      </div>

      <div class="relative w-full aspect-[4/3] bg-gray-50 overflow-hidden border-b border-gray-100">
        <div id="carousel-p-{{ $product->id }}" class="carousel slide h-full" data-bs-interval="false">
          <div class="carousel-inner h-full">
            @forelse($product->images as $index => $image)
            <div class="carousel-item h-full {{ $loop->first ? 'active' : '' }}">
              <img src="{{ asset('storage/app/public/' . $image->image_path) }}"
                class="d-block w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                alt="{{ $product->name }}">
            </div>
            @empty
            <div class="carousel-item active h-full flex items-center justify-center text-gray-300">
              <i class="fas fa-image fa-2x"></i>
            </div>
            @endforelse
          </div>

          @if($product->images->count() > 1)
          <button class="carousel-control-prev opacity-0 group-hover:opacity-100 transition-opacity duration-200" type="button" data-bs-target="#carousel-p-{{ $product->id }}" data-bs-slide="prev">
            <span class="bg-white/90 p-1.5 rounded-full text-gray-800 shadow-sm hover:bg-white" aria-hidden="true">
              <i class="fas fa-chevron-left text-xs"></i>
            </span>
          </button>
          <button class="carousel-control-next opacity-0 group-hover:opacity-100 transition-opacity duration-200" type="button" data-bs-target="#carousel-p-{{ $product->id }}" data-bs-slide="next">
            <span class="bg-white/90 p-1.5 rounded-full text-gray-800 shadow-sm hover:bg-white" aria-hidden="true">
              <i class="fas fa-chevron-right text-xs"></i>
            </span>
          </button>
          @endif
        </div>
      </div>

      <div class="p-4 flex flex-col flex-grow">

<div class="flex justify-between items-center mb-2">
    <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
        {{ $product->category->name ?? 'General' }}
    </span>
    <div class="flex items-center gap-1">
        <i class="fas fa-star text-yellow-400 text-[10px]"></i>
        <span class="text-xs font-semibold text-gray-600">{{ number_format($rating, 1) }}</span>
    </div>
</div>

<h3 class="text-gray-900 font-semibold text-[15px] leading-snug mb-1 line-clamp-2 group-hover:text-blue-600 transition-colors">
    <a href="{{ route('product.show', $product->slug) }}">
        {{ $product->name }}
    </a>
</h3>

<p class="text-gray-700 text-sm leading-snug mb-1">
    {{$product->decsription}}
</p>

<p class="text-gray-400 text-xs mb-2">1kg</p>

<div class="mt-auto pt-2 border-t border-gray-100 flex items-end justify-between gap-2">

    <div class="flex flex-col">
        @if($isDiscounted)
        <span class="text-xs text-gray-400 line-through">Rs {{ number_format($basePrice, 0) }}</span>
        @endif
        <span class="text-lg font-bold text-gray-900">
            Rs {{ number_format($finalPrice, 0) }}
        </span>
    </div>

    <div class="flex items-center gap-2">
    <!-- Buy Now Button -->
    <button id="buy_now"
        data-product-id="{{ $product->id }}"
        data-price="{{ $finalPrice }}"
        class="w-9 h-9 flex items-center justify-center rounded-lg border transition-colors text-white"
        style="background-color: var(--primary-color); border-color: var(--primary-color);"
        onmouseover="this.style.backgroundColor='var(--primary-hover)'; this.style.borderColor='var(--primary-hover)';"
        onmouseout="this.style.backgroundColor='var(--primary-color)'; this.style.borderColor='var(--primary-color)';"
        title="Buy Now">
        <i class="fas fa-bolt text-sm"></i>
    </button>

    <!-- Add to Cart Button -->
    <a href="{{ route('product.show', $product->slug) }}"
        class="h-9 px-4 flex items-center justify-center gap-2 rounded-lg text-white text-xs font-semibold tracking-wide shadow-sm transition-colors"
        style="background: var(--gradient-primary);"
        onmouseover="this.style.opacity='0.9';"
        onmouseout="this.style.opacity='1';">
        <span>ADD</span>
        <i class="fas fa-cart-plus"></i>
    </a>
</div>

</div>

      </div>
    </div>