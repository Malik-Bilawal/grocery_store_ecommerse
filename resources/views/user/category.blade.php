@extends("user.layouts.master-layouts.plain")

<title>Grocery Station One | Categories </title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@push("script")
@endpush

<link rel="stylesheet" href="{{ asset('css/category.css') }}">

@section('content')
<div class="page-bg">
    <!-- Floating Background Elements -->
    <div class="floating-element floating-element-1"></div>
    <div class="floating-element floating-element-2"></div>
    <div class="floating-element floating-element-3"></div>

<!-- Page Header / Hero -->
<section class="relative overflow-hidden py-28 bg-gradient-to-br from-[var(--primary-color)] via-[var(--secondary-color)] to-orange-500 text-white rounded-t-[16px] md:rounded-t-[24px]">
  
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/30 mix-blend-multiply"></div>

  <!-- Soft glow blobs -->
  <div class="absolute -top-20 -left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
  <div class="absolute top-40 right-20 w-96 h-96 bg-yellow-300/20 rounded-full blur-[120px]"></div>

  <!-- Hero Content -->
  <div class="relative container mx-auto px-6 text-center z-10">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-lg tracking-tight">
      <span class="block">Premium Grocery</span>
      <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-white">Categories</span>
    </h1>

    <p class="text-lg md:text-xl max-w-3xl mx-auto opacity-90 mb-10">
      Discover our carefully curated selection of fresh, high-quality groceries organized for your convenience.
    </p>

    <div class="flex justify-center gap-4">
      <a href="#categories" 
         class="px-8 py-3 rounded-full bg-white text-[var(--primary-color)] font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        Explore Categories
      </a>
      <a href="{{ route('contact') }}"
         class="px-8 py-3 rounded-full border border-white/60 text-white font-semibold hover:bg-white/10 hover:backdrop-blur-md transition-all duration-300">
        Contact Us
      </a>
    </div>
  </div>

  <!-- Symmetrical Heavy Wavy Bottom -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
    <svg class="block w-full h-32 md:h-40 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path fill="currentColor" d="
        M0,200 
        C120,280 240,120 360,200 
        C480,280 600,120 720,200 
        C840,280 960,120 1080,200 
        C1200,280 1320,120 1440,200 
        L1440,320 
        L0,320 
        Z">
      </path>
    </svg>
  </div>
</section>

<!-- Main Content -->
<main class="container mx-auto px-6 py-16">

    <!-- Stats Section -->
    <section class="stats-section text-center max-w-6xl mx-auto" data-aos="zoom-in">
<!-- Section Heading -->
<h2 class="section-title {var--primary} text-4xl md:text-5xl font-extrabold {var--primary} text-center mb-4 relative" 
    style="font-family: 'Poppins', 'Manrope', sans-serif; letter-spacing: -0.5px; line-height: 1.2;" 
    data-aos="fade-up">
  FreshGrocer Categories 
  <!-- Elegant underline accent -->
  <span class="absolute left-1/2 bottom-0 -translate-x-1/2 w-28 h-1 rounded-full 
               bg-gradient-to-r from-[var(--primary-color)] via-[var(--secondary-color)] to-yellow-400 
               shadow-[0_2px_6px_rgba(0,0,0,0.1)]"></span>
</h2>

<!-- Supporting paragraph -->
<p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-12 leading-relaxed text-center" 
   style="font-family: 'Poppins', 'Manrope', sans-serif;">
  Explore our comprehensive collection of premium grocery categories, each offering the finest selection of products for your needs.
</p>



        <div class="stats-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Categories -->
            <div class="stat-item bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-1">
                <div class="stat-icon mb-4 w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-br from-[var(--primary-color)] to-[var(--secondary-color)] text-white text-2xl">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-number text-3xl font-bold text-gray-800 mb-1">{{ count($categories) }}+</div>
                <div class="stat-label text-gray-500 font-medium">Categories</div>
            </div>

            <!-- Subcategories -->
            <div class="stat-item bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-1">
                <div class="stat-icon mb-4 w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-br from-[var(--secondary-color)] to-[var(--accent-color)] text-white text-2xl">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-number text-3xl font-bold text-gray-800 mb-1">{{ $subcategories->count() }}+</div>
                <div class="stat-label text-gray-500 font-medium">Subcategories</div>
            </div>

            <!-- Products -->
            <div class="stat-item bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-1">
                <div class="stat-icon mb-4 w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-br from-[var(--accent-color)] to-[var(--primary-color)] text-white text-2xl">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-number text-3xl font-bold text-gray-800 mb-1">
                    @php
                        $totalProducts = 0;
                        foreach($categories as $category) {
                            $totalProducts += $category->products_count ?? $category->products()->count();
                        }
                        echo $totalProducts . '+';
                    @endphp
                </div>
                <div class="stat-label text-gray-500 font-medium">Products</div>
            </div>

            <!-- Fresh Quality -->
            <div class="stat-item bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-1">
                <div class="stat-icon mb-4 w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-orange-400 text-white text-2xl">
                    <i class="fas fa-award"></i>
                </div>
                <div class="stat-number text-3xl font-bold text-gray-800 mb-1">100%</div>
                <div class="stat-label text-gray-500 font-medium">Fresh Quality</div>
            </div>
        </div>
    </section>



<!-- Quick Links -->
<section class="quick-links py-16">
    <div class="container mx-auto px-6">
        <!-- Section Heading -->
        <h2 class="section-title text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-8 relative"
            style="font-family: 'Poppins', 'Manrope', sans-serif; letter-spacing: -0.5px; line-height: 1.2;"
            data-aos="fade-right">
            Quick Categories
            <span class="absolute left-1/2 bottom-0 -translate-x-1/2 w-28 h-1 rounded-full 
                   bg-gradient-to-r from-[var(--primary-color)] via-[var(--secondary-color)] to-yellow-400 
                   shadow-[0_2px_6px_rgba(0,0,0,0.1)]"></span>
        </h2>

        <div class="quick-links-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6" data-aos="fade-up">
            @foreach($categories->take(8) as $category)
            <a href="#category-{{ $category->id }}" 
               class="quick-link flex items-center gap-3 p-4 bg-white rounded-2xl shadow-lg hover:shadow-xl transition hover:-translate-y-1 border border-gray-100 hover:border-[var(--primary-color)]"
               onclick="scrollToCategory(event, {{ $category->id }})">
                <span class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-[var(--primary-color)] to-[var(--secondary-color)] text-white rounded-full text-lg">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text-gray-800 font-medium hover:text-[var(--primary-color)] transition">
                    {{ $category->name }}
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<script>
function scrollToCategory(event, categoryId) {
    event.preventDefault(); // prevent default anchor behavior

    const target = document.getElementById(`category-${categoryId}`);
    if (target) {
        // Scroll smoothly to the category card
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Optional: highlight the category card
        document.querySelectorAll('.category-card').forEach(el => el.classList.remove('highlight'));
        target.classList.add('highlight');

        // Optional: apply the filter automatically
        if (typeof applyCategoryFilter === 'function') {
            applyCategoryFilter(categoryId);
        }
    }
}
</script>

<style>
/* Highlight effect when scrolled to */
.category-card.highlight {
    transition: background 0.5s;
    background-color: rgba(255, 229, 100, 0.3);
}
</style>


<!-- Featured Categories Section -->
<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-6">
<!-- Section Heading -->
<h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-12 relative" 
    data-aos="fade-right" 
    style="font-family: 'Manrope', 'Poppins', sans-serif; letter-spacing: -0.5px; line-height: 1.2;">
  Featured Categories
  <span class="absolute left-1/2 bottom-0 -translate-x-1/2 w-32 h-1 rounded-full 
               bg-gradient-to-r from-[var(--primary-color)] via-[var(--secondary-color)] to-yellow-400 
               shadow-[0_2px_8px_rgba(0,0,0,0.15)]"></span>
  <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-2xl text-yellow-400">★</span>
</h2>


    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach($categories->take(3) as $category)
      <div class="group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-transform duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
        
        <!-- Image -->
<!-- Image -->
<div class="relative w-full h-64 md:h-72 lg:h-80 overflow-hidden rounded-t-3xl">
<img 
  src="{{ $category->image ? asset('storage/app/public/' . $category->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80' }}" 
  alt="{{ $category->name }}" 
  class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
/>


  <!-- Badge -->
  <div class="absolute top-4 right-4 bg-[var(--primary-color)] text-white font-semibold px-3 py-1 rounded-full text-sm opacity-90 group-hover:opacity-100 transition-opacity duration-300 z-10">
    Featured
  </div>
</div>


        <!-- Content -->
        <div class="p-6 bg-white flex flex-col">
          <h3 class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-[var(--primary-color)] transition-colors">
            {{ $category->name }}
          </h3>
          <p class="text-gray-600 text-sm md:text-base mb-5 leading-relaxed flex-grow">
            Discover our premium selection of {{ $category->name }} featuring the freshest ingredients, highest quality standards, and carefully curated products.
          </p>

          <!-- Stats & Button -->
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-gray-700 font-medium">
              <i class="fas fa-box text-[var(--secondary-color)]"></i>
              <span>{{ $category->products_count ?? $category->products()->count() }} Products</span>
            </div>
            <button onclick="setCategoryAndRedirect({{ $category->id }})"
        class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-[var(--primary-color)] to-[var(--secondary-color)] text-white rounded-full font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-transform duration-300">
  Explore <i class="fas fa-arrow-right"></i>
</button>

<script>
function setCategoryAndRedirect(categoryId) {
    localStorage.setItem('selectedCategory', categoryId);
    window.location.href = '/product';
}
</script>

          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>


<!-- All Categories Section -->
<section class="all-categories py-20 bg-gray-50" id="all">
  <div class="container mx-auto px-6">

    <!-- Section Heading -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-12 relative"
        data-aos="fade-up"
        style="font-family: 'Poppins', 'Manrope', sans-serif; letter-spacing: -0.5px; line-height: 1.2;">
      All Categories
      <span class="absolute left-1/2 bottom-0 -translate-x-1/2 w-32 h-1 rounded-full 
                   bg-gradient-to-r from-[var(--primary-color)] via-[var(--secondary-color)] to-yellow-400 
                   shadow-[0_2px_6px_rgba(0,0,0,0.1)]"></span>
    </h2>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 stagger-animation">
      @foreach($categories as $category)
      <div id="category-{{ $category->id }}" 
           onclick="applyCategoryAndRedirect({{ $category->id }})"
           class="category-card group relative cursor-pointer rounded-[2.5rem] overflow-hidden shadow-2xl
                  transition-transform duration-500 transform hover:-translate-y-2 bg-white">

        <!-- Blob Background -->
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-br from-[#FFDEE9] via-[#B5FFFC] to-[#C6FFDD] 
                    rounded-full opacity-40 blur-3xl animate-float"></div>
        <div class="absolute -bottom-10 -right-10 w-56 h-56 bg-gradient-to-tr from-[#FFD1FF] via-[#A1FFEA] to-[#FFF6C3] 
                    rounded-full opacity-30 blur-3xl animate-float-delay-3"></div>

        <!-- Image -->
        <div class="relative w-full h-64 sm:h-72 md:h-64 lg:h-72 overflow-hidden rounded-t-[2.5rem]">
          <img src="{{ $category->image ? asset('storage/app/public/' . $category->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80' }}" 
               alt="{{ $category->name }}" 
               class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105 rounded-t-[2.5rem]">
          
          <!-- Overlay -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent flex flex-col justify-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-t-[2.5rem]">
            <div class="text-white">
              <h3 class="text-xl md:text-2xl font-bold mb-2">{{ $category->name }}</h3>
              <div class="flex items-center gap-2 text-sm md:text-base opacity-90 font-medium">
                <i class="fas fa-box"></i>
                <span>{{ $category->products_count ?? $category->products()->count() }} Products</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="p-4 bg-white flex justify-between items-center border-t border-gray-100 group-hover:bg-gradient-to-r from-[var(--primary-color)] to-[var(--secondary-color)] transition-colors duration-500 rounded-b-[2.5rem]">
          <h3 class="text-lg font-semibold text-gray-800 group-hover:text-white transition-colors">
            {{ $category->name }}
          </h3>
          <i class="fas fa-arrow-right text-[var(--secondary-color)] group-hover:text-white transition-colors"></i>
        </div>

      </div>
      @endforeach
    </div>

  </div>
</section>

<!-- JS -->
<script>
function applyCategoryAndRedirect(categoryId) {
    localStorage.setItem('selectedCategory', categoryId);
    window.location.href = '/product';
}
</script>

<!-- CSS Animations -->
<style>
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-15px); }
}
.animate-float { animation: float 6s ease-in-out infinite; }
.animate-float-delay-3 { animation: float 8s ease-in-out infinite 1.5s; }
</style>

<!-- Smooth Scroll CSS -->
<style>
  html {
    scroll-behavior: smooth;
  }

  /* Staggered animation */
  .stagger-animation > * {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.6s forwards;
  }
  @keyframes fadeInUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .stagger-animation > *:nth-child(1) { animation-delay: 0.05s; }
  .stagger-animation > *:nth-child(2) { animation-delay: 0.1s; }
  .stagger-animation > *:nth-child(3) { animation-delay: 0.15s; }
  .stagger-animation > *:nth-child(4) { animation-delay: 0.2s; }
  .stagger-animation > *:nth-child(5) { animation-delay: 0.25s; }
  .stagger-animation > *:nth-child(6) { animation-delay: 0.3s; }
  .stagger-animation > *:nth-child(7) { animation-delay: 0.35s; }
  .stagger-animation > *:nth-child(8) { animation-delay: 0.4s; }
</style>

    </main>
</div>
@endsection

@push('script')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Smooth scroll for quick links
        document.querySelectorAll('.quick-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Category card interactions

        // Explore button interactions
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.category-card, .featured-category, .popular-category').forEach(el => {
            observer.observe(el);
        });

       
            
     

        // Add parallax effect to header
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.page-header');
            if (parallax) {
                parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    });
</script>
@endpush