
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#0f172a', // Slate 900
                            darker: '#020617', // Slate 950
                            accent: '#f97316', // Orange 500
                            glow: '#fb923c', // Orange 400
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        

        /* Smooth Scroll behavior */
        html { scroll-behavior: smooth; }

        /* Custom Hover Underline Animation */
        .hover-link {
            position: relative;
            display: inline-block;
        }
        .hover-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #f97316;
            transition: width 0.3s ease;
        }
        .hover-link:hover::after {
            width: 100%;
        }

        /* Glass Effect Class */
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>



    <footer class="relative bg-brand-darker text-slate-300 pt-20 pb-10 overflow-hidden font-sans">
        
        <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-brand-accent/20 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16 items-start border-b border-white/5 pb-12">
                
                <div class="lg:col-span-5 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-accent to-red-600 flex items-center justify-center shadow-lg shadow-orange-500/20">
                            <i class="fas fa-shopping-basket text-white text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white tracking-tight">Grocery Station One</h2>
                    </div>
                    <p class="text-slate-400 text-lg font-light leading-relaxed max-w-md">
                        Redefining the daily market experience. Freshness delivered with precision, quality curated with care.
                    </p>
                    
                    <div class="flex flex-wrap gap-3 pt-2">
                        <a href="#" class="group flex items-center gap-2 px-4 py-2 rounded-full glass-panel hover:bg-white/10 transition-all duration-300">
                            <i class="fab fa-facebook-f text-brand-accent group-hover:text-white transition-colors"></i>
                            <span class="text-xs font-medium">Facebook</span>
                        </a>
                        <a href="https://www.instagram.com/grocerystationone?igsh=NWJxMDIya3dsYXU5"  target="_blank" class="group flex items-center gap-2 px-4 py-2 rounded-full glass-panel hover:bg-white/10 transition-all duration-300">
                            <i class="fab fa-instagram text-brand-accent group-hover:text-white transition-colors"></i>
                            <span class="text-xs font-medium">Instagram</span>
                        </a>
                        <a href="#" class="group flex items-center gap-2 px-4 py-2 rounded-full glass-panel hover:bg-white/10 transition-all duration-300">
                            <i class="fab fa-linkedin-in text-brand-accent group-hover:text-white transition-colors"></i>
                            <span class="text-xs font-medium">LinkedIn</span>
                        </a>
                    </div>
                </div>

                {{-- <div class="lg:col-span-7">
                    <div class="glass-panel rounded-2xl p-8 md:p-10 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-accent/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 transition-opacity opacity-50 group-hover:opacity-100 duration-700"></div>

                        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">Join the inner circle</h3>
                                <p class="text-slate-400 text-sm">Get exclusive offers and weekly freshness updates.</p>
                            </div>
                            <form class="w-full md:w-auto flex-1 max-w-md relative">
                                <div class="flex items-center bg-brand-darker/50 border border-white/10 rounded-full p-1 focus-within:border-brand-accent/50 focus-within:ring-2 focus-within:ring-brand-accent/20 transition-all duration-300">
                                    <input 
                                        type="email" 
                                        placeholder="Your email address..." 
                                        class="bg-transparent border-none text-white placeholder-slate-500 text-sm w-full px-5 focus:ring-0 focus:outline-none h-12"
                                    >
                                    <button type="submit" class="bg-brand-accent hover:bg-orange-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg shadow-orange-500/30 transition-all duration-300 hover:scale-105">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12 mb-16">
                
                <div>
                    <h4 class="text-white font-semibold mb-6 tracking-wide text-sm uppercase opacity-80">Explore</h4>
                    <ul class="space-y-4">
                        <li><a href="home" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">Home</a></li>
                        <li><a href="about" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">Our Story</a></li>
                        <li><a href="product" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">All Products</a></li>
                        <li><a href="#" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">Flash Sales <span class="ml-2 text-[10px] bg-red-500/20 text-red-400 px-2 py-0.5 rounded-full">Hot</span></a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-6 tracking-wide text-sm uppercase opacity-80">Top Categories</h4>
                    <ul class="space-y-4">
                        @php
                            $footerCategories = \App\Models\Category::orderBy('name')->take(6)->get();
                        @endphp
                        
                        @forelse($footerCategories as $category)
                            <li>
                                <button onclick="setCategoryAndRedirect({{ $category->id }})" 
                                   class="group flex items-center text-slate-400 hover:text-brand-accent transition-colors text-sm">
                                   <span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-brand-accent mr-3 transition-colors"></span>
                                   {{ $category->name }}
    </button>
                            </li>
                        @empty 
                            <li><a href="#" class="group flex items-center text-slate-400 hover:text-brand-accent transition-colors text-sm"><span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-brand-accent mr-3 transition-colors"></span>Fresh Fruits</a></li>
                            <li><a href="#" class="group flex items-center text-slate-400 hover:text-brand-accent transition-colors text-sm"><span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-brand-accent mr-3 transition-colors"></span>Organic Veggies</a></li>
                            <li><a href="#" class="group flex items-center text-slate-400 hover:text-brand-accent transition-colors text-sm"><span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-brand-accent mr-3 transition-colors"></span>Meat & Seafood</a></li>
                            <li><a href="#" class="group flex items-center text-slate-400 hover:text-brand-accent transition-colors text-sm"><span class="w-1.5 h-1.5 rounded-full bg-slate-600 group-hover:bg-brand-accent mr-3 transition-colors"></span>Beverages</a></li>
                        @endforelse 
                    </ul>
                </div>
<script>
                function setCategoryAndRedirect(categoryId) {
    localStorage.setItem('selectedCategory', categoryId);
    window.location.href = '/product';
}
</script>

                <div>
                    <h4 class="text-white font-semibold mb-6 tracking-wide text-sm uppercase opacity-80">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">Help Center</a></li>
                        <li><a href="#" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">Terms of Service</a></li>
                        <li><a href="#" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">Privacy Policy</a></li>
                        <li><a href="#" class="hover-link text-slate-400 hover:text-white transition-colors text-sm">Return Policy</a></li>
                    </ul>
                </div>
                <div>
    <div class="bg-white/5 rounded-xl p-6 border border-white/5">
        <h4 class="text-white font-semibold mb-4 text-sm">Need Help?</h4>

        <ul class="space-y-4">

            <!-- LOCATION -->
            <li class="flex items-start gap-3 text-sm text-slate-400">
                <i class="fas fa-map-marker-alt text-brand-accent mt-1"></i>
                <span>Jodia Bazar, Karachi,<br>Pakistan</span>
            </li>

            <!-- PHONE (WHATSAPP CLICKABLE) -->
            <li class="flex items-center gap-3 text-sm text-slate-400">
                <i class="fas fa-phone-alt text-brand-accent"></i>
                <a href="https://wa.me/923188270460" 
                   target="_blank"
                   class="hover:text-white transition-colors cursor-pointer">
                    +92 318 8270460
                </a>
            </li>

            <!-- EMAIL CLICKABLE -->
            <li class="flex items-center gap-3 text-sm text-slate-400">
                <i class="fas fa-envelope text-brand-accent"></i>
                <a href="mailto:support@gso.com" 
                   class="hover:text-white transition-colors cursor-pointer">
                    team@grocerystationone.com
                </a>
            </li>

        </ul>
    </div>
</div>

            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/5 gap-6">
                <div class="text-slate-500 text-sm font-light">
                    &copy; 2023 <strong class="text-slate-300">GSO</strong>. All rights reserved.
                </div>

                <div class="flex gap-4">
                    <div class="opacity-50 hover:opacity-100 transition-opacity duration-300 grayscale hover:grayscale-0 bg-white/5 p-2 rounded cursor-pointer">
                        <i class="fab fa-cc-visa text-white text-2xl"></i>
                    </div>
                    <div class="opacity-50 hover:opacity-100 transition-opacity duration-300 grayscale hover:grayscale-0 bg-white/5 p-2 rounded cursor-pointer">
                        <i class="fab fa-cc-mastercard text-red-500 text-2xl"></i>
                    </div>
                    <div class="opacity-50 hover:opacity-100 transition-opacity duration-300 grayscale hover:grayscale-0 bg-white/5 p-2 rounded cursor-pointer">
                        <i class="fab fa-cc-paypal text-blue-500 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

