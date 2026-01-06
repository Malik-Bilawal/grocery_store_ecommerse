<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Station One (GSO) - Premium Grocery Store</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>


        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Premium Navbar Styling */
        .premium-navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        }

        .nav-glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .logo-glow {
            filter: drop-shadow(0 4px 12px rgba(249, 115, 22, 0.3));
        }

        .icon-3d {
            transform: translateZ(0);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .icon-3d:hover {
            transform: translateY(-2px) scale(1.05);
        }

        .badge-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }

            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .gradient-text {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-border {
            position: relative;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: inherit;
            padding: 2px;
            background: var(--gradient-primary);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        /* Default underline effect */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        /* Hover underline */
        .nav-link:hover::after {
            width: 100%;
        }

        /* Active route underline */
        .nav-link.active::after {
            width: 100%;
        }

        /* Optional: color change when active */
        .nav-link.active {
            color: var(--primary-color);
        }

        /* Premium Search Drawer */
        .premium-search-drawer {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-left: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: -20px 0 60px rgba(0, 0, 0, 0.1);
        }

        .search-input-glow:focus {
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1), 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .category-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            background: var(--gradient-primary);
        }

        .category-card:hover i,
        .category-card:hover p,
        .category-card:hover span {
            color: white !important;
        }

        /* Premium Dropdown */
        .premium-dropdown {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .mobile-menu-premium {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .floating-action {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Custom scrollbar */
        .premium-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .premium-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        .premium-scrollbar::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 10px;
        }

        /* Animations */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slideInRight {
            animation: slideInRight 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        /* Button styles */
        .btn-premium {
            background: var(--gradient-primary);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gradient-secondary);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .btn-premium:hover::before {
            left: 0;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': 'var(--primary-color)',
                        'primary-hover': 'var(--primary-hover)',
                        'secondary': 'var(--secondary-color)',
                        'secondary-hover': 'var(--secondary-hover)',
                        'accent': 'var(--accent-color)',
                        'accent-hover': 'var(--accent-hover)',
                        'text-on-primary': 'var(--text-on-primary)',
                        'text-on-secondary': 'var(--text-on-secondary)',
                        'dark-gray': '#1f2937',
                        'light-gray': '#f8fafc',
                        'light-orange': 'var(--light-orange)',
                        'dark-orange': 'var(--dark-orange)'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    },
                    boxShadow: {
                        'premium': '0 25px 50px -12px rgba(0, 0, 0, 0.15)',
                        'premium-lg': '0 32px 64px -12px rgba(0, 0, 0, 0.2)',
                        'glow': '0 0 30px rgba(249, 115, 22, 0.3)'
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                    }
                }
            }
        }
    </script>
</head>

<!-- Top Marquee Bar -->


<body class="font-sans bg-light-gray mb-16">

<!-- MARQUEE BAR -->
<!-- TOP ANNOUNCEMENT BAR -->
<style>
@keyframes marquee {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
.animate-marquee {
    animation: marquee 28s linear infinite;
}
.animate-marquee:hover {
    animation-play-state: paused;
}
</style>

<div class="fixed top-0 left-0 w-full z-40 backdrop-blur-md 
            bg-gradient-to-r from-green-700/95 via-green-600/95 to-emerald-600/95 
            text-white border-b border-white/10 shadow-md">
    
    <div class="h-10 md:h-11 flex items-center overflow-hidden">
        <div class="flex items-center whitespace-nowrap animate-marquee gap-10 px-8 
                    text-[11px] md:text-sm font-semibold tracking-wide uppercase">
            
            <span class="flex items-center gap-2">
                {{-- <span class="text-yellow-300">🔥</span>
                Free delivery on 5000 + shopping
                        </span> --}}

            <span class="w-1 h-1 rounded-full bg-white/40"></span>

            <span class="flex items-center gap-2">
            imported items            </span>

            <span class="w-1 h-1 rounded-full bg-white/40">
            </span>

    <span class="flex items-center gap-2">
       Our Prices are literally lower as compare to stores
            </span>

            <span class="w-1 h-1 rounded-full bg-white/40"></span>

            {{-- <span class="flex items-center gap-2">
                🚚 Free Delivery on Orders Above 5000
            </span> --}}
        </div>
    </div>
</div>

<!-- PUSH CONTENT DOWN -->


    <!-- Premium Navigation Bar -->
    <style>


    /* Glass Effect */
    .glass-nav {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Nav Link Hover Pill */
    .nav-pill {
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-pill:hover {
        background-color: #fff7ed; /* Light Orange Background */
        color: #ea580c; /* Darker Orange Text */
        transform: translateY(-1px);
    }

    /* Badge Pulse Animation */
    @keyframes subtle-pulse {
        0% { box-shadow: 0 0 0 0 rgba(234, 88, 12, 0.4); }
        70% { box-shadow: 0 0 0 6px rgba(234, 88, 12, 0); }
        100% { box-shadow: 0 0 0 0 rgba(234, 88, 12, 0); }
    }
    .badge-pulse {
        animation: subtle-pulse 2s infinite;
    }
    .logo-div{
        border-radius: 50% , 50%;
    }
</style>
<nav class="glass-nav fixed top-10 left-0 right-0 z-50 transition-all duration-300 overflow-visible">
    <div class="container mx-auto px-4 lg:px-8 py-3 flex justify-between items-center relative">
        
        <div class="flex items-center logo-div gap-4 group cursor-pointer relative z-10"> 
            
            <img src="../../loggo.png" 
                 class="w-24 h-24 object-contain max-w-none -my-8 drop-shadow-2xl hover:scale-110 transition-transform duration-300">
            
        
</div>
        <div class="hidden lg:flex items-center gap-1 bg-gray-100/50 p-1.5 rounded-full border border-gray-100">
            <a href="{{ route('home') }}" 
               class="nav-pill px-5 py-2.5 rounded-full text-sm font-semibold {{ request()->routeIs('home') ? 'bg-white text-orange-600 shadow-sm' : 'text-slate-600' }}">
               Home
            </a>
            <a href="{{ route('product') }}" 
               class="nav-pill px-5 py-2.5 rounded-full text-sm font-semibold {{ request()->routeIs('product') ? 'bg-white text-orange-600 shadow-sm' : 'text-slate-600' }}">
               Products
            </a>
            <a href="{{ route('category') }}" 
               class="nav-pill px-5 py-2.5 rounded-full text-sm font-semibold {{ request()->routeIs('category') ? 'bg-white text-orange-600 shadow-sm' : 'text-slate-600' }}">
               Categories
            </a>
            <a href="{{ route('about') }}" 
               class="nav-pill px-5 py-2.5 rounded-full text-sm font-semibold {{ request()->routeIs('about') ? 'bg-white text-orange-600 shadow-sm' : 'text-slate-600' }}">
               About
            </a>
            <a href="{{ route('contact') }}" 
               class="nav-pill px-5 py-2.5 rounded-full text-sm font-semibold {{ request()->routeIs('contact') ? 'bg-white text-orange-600 shadow-sm' : 'text-slate-600' }}">
               Contact
            </a>
        </div>

        <div class="flex items-center gap-2 lg:gap-4">
            
            <button id="search-button" class="group relative w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-full border border-gray-200 hover:border-orange-200 bg-white hover:bg-orange-50 transition-all duration-300">
                <i class="fas fa-search text-slate-500 group-hover:text-orange-500 transition-colors text-lg"></i>
            </button>

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
            <a href="{{ route('cart.index') }}" class="group relative w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-full border border-gray-200 hover:border-orange-200 bg-white hover:bg-orange-50 transition-all duration-300">
                <i class="fas fa-shopping-basket text-slate-500 group-hover:text-orange-500 transition-colors text-lg"></i>
                
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-gradient-to-r from-orange-500 to-red-500 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg badge-pulse border-2 border-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <div class="relative inline-block text-left">
            <button id="userMenuButton" 
    class="group relative w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center rounded-full border border-gray-200 hover:border-orange-200 bg-white hover:bg-orange-50 transition-all duration-300 focus:ring-4 focus:ring-orange-100">
    <i class="fas fa-user text-slate-500 group-hover:text-orange-500 transition-colors text-lg"></i>
</button>


                <div id="userMenuDropdown" class="hidden absolute right-0 mt-4 w-72 rounded-2xl bg-white shadow-[0_20px_50px_rgba(8,_112,_184,_0.1)] border border-gray-100 ring-1 ring-black ring-opacity-5 transform opacity-0 scale-95 origin-top-right transition-all duration-200 z-50">
                    
                    @auth
                    <div class="p-5 bg-gradient-to-br from-gray-50 to-white border-b border-gray-100 rounded-t-2xl">
                        <p class="text-xs text-orange-500 font-bold tracking-wider uppercase mb-1">Signed in as</p>
                        <p class="font-bold text-slate-800 text-lg truncate">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="p-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all group">
                                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                Sign Out
                            </button>
                        </form>
                    </div>
                    @endauth

                    @guest
                    <div class="p-4 space-y-3">
                        <div class="text-center mb-2">
                            <p class="text-slate-800 font-bold text-lg">Welcome!</p>
                            <p class="text-slate-500 text-sm">Sign in to access your account</p>
                        </div>
                        <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-3 bg-slate-900 text-white rounded-xl font-semibold shadow-lg shadow-slate-900/20 hover:bg-slate-800 hover:scale-[1.02] transition-all">
                            Login
                        </a>
                        <a href="{{ route('user.register') }}" class="flex items-center justify-center w-full py-3 bg-orange-50 text-orange-600 rounded-xl font-semibold hover:bg-orange-100 transition-all">
                            Create Account
                        </a>
                    </div>
                    @endguest
                </div>
            </div>

            <script>
const userButton = document.getElementById('userMenuButton');
const userDropdown = document.getElementById('userMenuDropdown');

userButton.addEventListener('click', (e) => {
    e.stopPropagation();

    const isHidden = userDropdown.classList.contains('hidden');

    if (isHidden) {
        // Show dropdown
        userDropdown.classList.remove('hidden');
        setTimeout(() => {
            userDropdown.classList.remove('opacity-0', 'scale-95');
            userDropdown.classList.add('opacity-100', 'scale-100');
        }, 10); // small delay so transition works
    } else {
        // Hide dropdown
        userDropdown.classList.add('opacity-0', 'scale-95');
        userDropdown.classList.remove('opacity-100', 'scale-100');

        setTimeout(() => {
            userDropdown.classList.add('hidden');
        }, 200); // must match your transition duration
    }
});

// Close when clicking outside
document.addEventListener('click', (e) => {
    if (!userDropdown.contains(e.target) && !userButton.contains(e.target)) {
        userDropdown.classList.add('opacity-0', 'scale-95');
        userDropdown.classList.remove('opacity-100', 'scale-100');

        setTimeout(() => {
            userDropdown.classList.add('hidden');
        }, 200);
    }
});

</script>



            <button id="mobile-menu-button" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-slate-800 hover:bg-orange-50 hover:text-orange-600 transition-all">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden hidden opacity-0 scale-95 transition-all duration-200 border-t border-gray-100 bg-white/95 backdrop-blur-xl absolute w-full left-0 shadow-2xl z-40">
        <div class="p-4 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-orange-50 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-orange-200 group-hover:text-orange-600 transition-all">
                    <i class="fas fa-home text-slate-500"></i>
                </div>
                <span class="font-bold text-slate-700 group-hover:text-slate-900">Home</span>
            </a>
            
            <a href="{{ route('product') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-orange-50 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-orange-200 group-hover:text-orange-600 transition-all">
                    <i class="fas fa-box text-slate-500"></i>
                </div>
                <span class="font-bold text-slate-700 group-hover:text-slate-900">Products</span>
            </a>

            <a href="{{ route('category') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-orange-50 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-orange-200 group-hover:text-orange-600 transition-all">
                    <i class="fas fa-tags text-slate-500"></i>
                </div>
                <span class="font-bold text-slate-700 group-hover:text-slate-900">Categories</span>
            </a>

            <a href="{{ route('about') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-orange-50 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-orange-200 group-hover:text-orange-600 transition-all">
                    <i class="fas fa-tags text-slate-500"></i>
                </div>
                <span class="font-bold text-slate-700 group-hover:text-slate-900">About</span>
            </a>

            <a href="{{ route('contact') }}" class="flex items-center gap-2 p-4 rounded-xl hover:bg-orange-50 transition-colors group">
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-orange-200 group-hover:text-orange-600 transition-all">
                    <i class="fas fa-tags text-slate-500"></i>
                </div>
                <span class="font-bold text-slate-700 group-hover:text-slate-900">Contact</span>
            </a>

            <div class="pt-4 mt-2 border-t border-gray-100 grid grid-cols-2 gap-3">
                @auth
                    <a href="{{ route('logout') }}" class="col-span-2 text-center py-3.5 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition-all">
                        Logout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-center py-3.5 bg-slate-900 text-white font-bold rounded-xl shadow-lg hover:bg-slate-800 transition-all">
                        Login
                    </a>
                    <a href="{{ route('user.register') }}" class="text-center py-3.5 bg-gray-100 text-slate-800 font-bold rounded-xl hover:bg-gray-200 transition-all">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>



<script>
document.addEventListener("DOMContentLoaded", () => {
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    mobileMenuButton.addEventListener("click", (e) => {
        e.stopPropagation();

        const isHidden = mobileMenu.classList.contains("hidden");

        if (isHidden) {
            // Show menu
            mobileMenu.classList.remove("hidden");
            setTimeout(() => {
                mobileMenu.classList.remove("opacity-0", "scale-95");
                mobileMenu.classList.add("opacity-100", "scale-100");
            }, 10);
        } else {
            // Hide menu
            mobileMenu.classList.add("opacity-0", "scale-95");
            mobileMenu.classList.remove("opacity-100", "scale-100");

            setTimeout(() => {
                mobileMenu.classList.add("hidden");
            }, 200);
        }
    });

    // Close when clicking outside
    document.addEventListener("click", (e) => {
        if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
            if (!mobileMenu.classList.contains("hidden")) {
                mobileMenu.classList.add("opacity-0", "scale-95");
                mobileMenu.classList.remove("opacity-100", "scale-100");

                setTimeout(() => {
                    mobileMenu.classList.add("hidden");
                }, 200);
            }
        }
    });
});
</script>


    <!-- Premium Search Drawer -->
    <div id="search-drawer"
        class="fixed inset-y-0 right-0 w-full md:w-2/5 lg:w-1/3 premium-search-drawer transform translate-x-full z-50 transition-all duration-400 hidden">
        <div class="p-6 h-full flex flex-col">
            <!-- Premium Header -->
            <div class="flex justify-between items-center pb-5 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="gradient-border p-1 rounded-xl">
                        <div class="bg-gradient-to-r from-primary to-secondary p-2 rounded-lg">
                            <i class="fas fa-search text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-dark-gray">Search Products</h2>
                        <p class="text-xs text-gray-500">Find your favorite groceries</p>
                    </div>
                </div>
                <button id="close-search" class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-100 transition-all icon-3d">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Premium Search Input -->
            <div class="py-6">
                <div class="relative">
                    <input
                        type="text"
                        id="search-input"
                        placeholder="Search for fruits, vegetables, dairy..."
                        class="w-full p-4 pl-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all search-input-glow">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <kbd class="px-2 py-1 text-xs font-semibold text-gray-400 bg-gray-100 border border-gray-200 rounded">⌘K</kbd>
                    </div>
                </div>
            </div>

            <!-- Popular Searches -->
            @php
            use App\Models\Product;
            $latestProducts = Product::latest()->take(6)->get();
            @endphp

            <div class="mb-6">
                <h3 class="text-lg font-black text-dark-gray mb-3 flex items-center">
                    <i class="fas fa-bolt text-primary mr-2"></i> Latest Products
                </h3>
                <style>
                    /* 1. Define the animation */
                    @keyframes marquee {
                        0% {
                            transform: translateX(0);
                        }

                        100% {
                            transform: translateX(-50%);
                        }

                        /* Move exactly half the total width */
                    }

                    /* 2. Apply the animation */
                    .animate-marquee {
                        display: flex;
                        width: max-content;
                        /* Force items to stay in one long line */
                        animation: marquee 20s linear infinite;
                        /* Adjust '20s' to change speed */
                    }

                    /* 3. Pause on hover */
                    .animate-marquee:hover {
                        animation-play-state: paused;
                    }

                    /* Utility to hide scrollbar if needed */
                    .no-scrollbar::-webkit-scrollbar {
                        display: none;
                    }

                    .no-scrollbar {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }

                    /* Fade effects */
                    .fade-mask {
                        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
                        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
                    }
                </style>

                <div class="relative w-full overflow-hidden fade-mask py-2">
                    <div class="animate-marquee flex gap-3">

                        <div class="flex gap-3 shrink-0">
                            @forelse($latestProducts as $product)
                            <a href="#" class="inline-block bg-gray-100 text-gray-700 px-5 py-2 rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-colors shadow-sm whitespace-nowrap">
                                {{ $product->name }}
                            </a>
                            @empty
                            <span class="text-gray-500 text-sm">No products available.</span>
                            @endforelse
                        </div>

                        <div class="flex gap-3 shrink-0">
                            @foreach($latestProducts as $product)
                            <a href="#" class="inline-block bg-gray-100 text-gray-700 px-5 py-2 rounded-full text-sm font-medium hover:bg-primary hover:text-white transition-colors shadow-sm whitespace-nowrap">
                                {{ $product->name }}
                            </a>
                            @endforeach
                        </div>

                    </div>
                </div>


            </div>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const box = document.getElementById("autoScrollProducts");
                    if (!box) {
                        console.log("❌ autoScrollProducts element not found!");
                        return;
                    } else {
                        console.log("✅ Found autoScrollProducts element", box);
                    }

                    let speed = 0.5;
                    let animationId;

                    // 1. Get total count from Blade
                    const totalItems = {
                        {
                            count($latestProducts)
                        }
                    };
                    console.log("🟢 Total items:", totalItems);

                    // Safety check: Need items to scroll
                    if (totalItems === 0) return;

                    function autoScroll() {
                        const firstItem = box.querySelector('.latest-product');
                        const allItems = box.querySelectorAll('.latest-product');
                        const firstDuplicate = allItems[totalItems];

                        if (firstItem && firstDuplicate) {
                            const scrollDistance = firstDuplicate.offsetLeft - firstItem.offsetLeft;

                            // Debug: print positions every frame
                            console.log("📏 firstItem.offsetLeft:", firstItem.offsetLeft,
                                "firstDuplicate.offsetLeft:", firstDuplicate.offsetLeft,
                                "scrollDistance:", scrollDistance,
                                "current scrollLeft:", box.scrollLeft.toFixed(2));

                            box.scrollLeft += speed;

                            if (box.scrollLeft >= scrollDistance) {
                                console.log("🔄 Reached duplicate, resetting scrollLeft");
                                box.scrollLeft = box.scrollLeft - scrollDistance;
                            }
                        } else {
                            console.log("⚠️ firstItem or firstDuplicate not found yet");
                        }

                        animationId = requestAnimationFrame(autoScroll);
                    }

                    console.log("🚀 Starting autoScroll animation");
                    animationId = requestAnimationFrame(autoScroll);

                    // Pause on hover / touch
                    box.addEventListener("mouseenter", () => {
                        cancelAnimationFrame(animationId);
                        console.log("⏸ Animation paused on hover");
                    });
                    box.addEventListener("mouseleave", () => {
                        cancelAnimationFrame(animationId);
                        console.log("▶️ Animation resumed on mouse leave");
                        animationId = requestAnimationFrame(autoScroll);
                    });
                    box.addEventListener("touchstart", () => {
                        cancelAnimationFrame(animationId);
                        console.log("⏸ Animation paused on touch");
                    });
                });
            </script>



            <!-- Search Results -->
            <div id="search-results" class="flex-1 overflow-y-auto premium-scrollbar">
                <div id="popular-recent">
                    <h3 class="text-lg font-black text-dark-gray mb-3 flex items-center">
                        <i class="fas fa-clock text-primary mr-2"></i> Recent Searches
                    </h3>
                    <div class="space-y-2">
                        <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all">
                            <i class="fas fa-history text-gray-400 mr-3"></i>
                            <span class="text-gray-700 font-medium">Organic Avocados</span>
                            <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all">
                                <i class="fas fa-times text-sm"></i>
                            </button>
                        </div>
                        <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all">
                            <i class="fas fa-history text-gray-400 mr-3"></i>
                            <span class="text-gray-700 font-medium">Greek Yogurt</span>
                            <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all">
                                <i class="fas fa-times text-sm"></i>
                            </button>
                        </div>
                        <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all">
                            <i class="fas fa-history text-gray-400 mr-3"></i>
                            <span class="text-gray-700 font-medium">Whole Wheat Bread</span>
                            <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all">
                                <i class="fas fa-times text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Suggested Categories -->
                    @php
                    use App\Models\Category;
                    $topCategories = Category::withCount('subcategories')
                    ->orderByDesc('subcategories_count')
                    ->take(4)
                    ->get();
                    @endphp

                    <h3 class="text-lg font-black text-dark-gray mt-8 mb-4 flex items-center">
                        <i class="fas fa-compass text-primary mr-2"></i> Browse Categories
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        @forelse($topCategories as $category)
                        <button  onclick="setCategoryAndRedirect({{ $category->id }})"
                            class="category-card p-4 rounded-xl text-center cursor-pointer group">
                            <i class="{{ $category->icon ?? 'fas fa-tag' }} text-2xl mb-3 group-hover:text-white text-primary"></i>
                            <p class="text-sm font-bold text-dark-gray group-hover:text-white">{{ $category->name }}</p>
                            <span class="text-xs text-gray-500 group-hover:text-white font-medium">
                                {{ $category->subcategories_count }} Subcategories
                            </span>
            </button>

                        <script>
                            function setCategoryAndRedirect(categoryId) {
    localStorage.setItem('selectedCategory', categoryId);
    window.location.href = '/product';
}
                        </script>
                        @empty
                        <p class="text-gray-500 text-sm col-span-2 text-center">No categories available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="overlay" class="fixed inset-0 bg-black opacity-0 pointer-events-none z-40 transition-opacity duration-300"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
 ;

        document.addEventListener('DOMContentLoaded', () => {
            const searchDrawer = document.getElementById('search-drawer');
            const searchButton = document.getElementById('search-button');
            const closeSearch = document.getElementById('close-search');
            const overlay = document.getElementById('overlay');
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');
            const popularRecent = document.getElementById('popular-recent');

            function openSearchDrawer() {
                searchDrawer.classList.remove('hidden', 'translate-x-full');
                searchDrawer.classList.add('animate-slideInRight'); // add animation here
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-50', 'pointer-events-auto');
                document.body.style.overflow = 'hidden';
                setTimeout(() => searchInput.focus(), 200);
            }

            function closeSearchDrawer() {
                searchDrawer.classList.remove('animate-slideInRight'); // remove animation on close
                searchDrawer.classList.add('translate-x-full');
                setTimeout(() => {
                    searchDrawer.classList.add('hidden');
                }, 300);

                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-50', 'pointer-events-auto');
                document.body.style.overflow = '';
            }


            function saveSearch(query) {
                if (!query) return;

                let searches = JSON.parse(localStorage.getItem('recentSearches')) || [];

                searches = searches.filter(q => q.toLowerCase() !== query.toLowerCase());
                searches.unshift(query);

                searches = searches.slice(0, 5);

                localStorage.setItem('recentSearches', JSON.stringify(searches));
            }

            function renderRecentSearches() {
                const container = document.querySelector('#popular-recent .space-y-2');
                const searches = JSON.parse(localStorage.getItem('recentSearches')) || [];

                container.innerHTML = '';

                if (searches.length > 0) {
                    searches.forEach(query => {
                        container.innerHTML += `
                    <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all recent-item" data-query="${query}">
                        <i class="fas fa-history text-gray-400 mr-3"></i>
                        <span class="text-gray-700 font-medium">${query}</span>
                        <button class="ml-auto text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-200 transition-all remove-recent">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                `;
                    });
                } else {
                    container.innerHTML = `
                <div class="text-gray-400 text-center py-6">
                    <i class="fas fa-box-open text-2xl mb-2"></i>
                    <p>No recent searches yet. Showing latest products...</p>
                </div>
            `;
                    fetchLatestProducts();
                }
            }

            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-recent')) {
                    const query = e.target.closest('.recent-item').dataset.query;
                    let searches = JSON.parse(localStorage.getItem('recentSearches')) || [];
                    searches = searches.filter(q => q !== query);
                    localStorage.setItem('recentSearches', JSON.stringify(searches));
                    renderRecentSearches();
                }
            });
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                if (query.length > 0) {
                    popularRecent.classList.add('hidden');
                    searchResults.classList.remove('hidden');

                    saveSearch(query);

                    fetch(`/search-products?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            searchResults.innerHTML = '';

                            if (data.length === 0) {
                                searchResults.innerHTML = `
                            <div class="flex flex-col items-center justify-center py-16">
                                <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-6 rounded-full mb-4">
                                    <i class="fas fa-search text-3xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-600 text-lg font-bold mb-2">No products found</p>
                                <p class="text-gray-400 text-sm">Try different keywords or browse categories</p>
                            </div>
                        `;
                                return;
                            }

                            data.forEach(product => {


                                searchResults.innerHTML += `

<a href="/product/${product.slug}" class="group block w-full">
    <div class="relative flex items-center p-3 mb-3 bg-white border border-gray-100 rounded-2xl shadow-sm transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:border-green-200 overflow-hidden">
        
        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-green-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        <div class="relative z-10 flex-shrink-0">
            <div class="h-16 w-16 rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100 group-hover:border-green-300 transition-colors">
                <img src="/storage/app/public/${product.image}" class="h-14 w-14 object-contain mix-blend-multiply" alt="${product.name}">
            </div>
            ${product.offer_price ? 
                `<span class="absolute -top-2 -left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">SALE</span>` 
                : ''}
        </div>

        <div class="relative z-10 flex-1 ml-4 mr-2">
            <h3 class="text-gray-800 font-bold text-base leading-tight group-hover:text-primary transition-colors line-clamp-1">
                ${product.name}
            </h3>
            
            <div class="flex items-end mt-1 space-x-2">
                <p class="text-primary font-black text-lg leading-none">
                    Rs. ${product.offer_price ?? product.price}
                </p>
                ${product.offer_price ? 
                    `<p class="text-gray-400 text-xs line-through font-medium mb-0.5">$${product.price}</p>` 
                    : ''}
            </div>
            
            <p class="text-green-600 text-[10px] font-bold mt-1 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                In Stock
            </p>
        </div>

        <div class="relative z-10">
            <div class="h-10 w-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center transition-all duration-300 group-hover:bg-gradient-to-r group-hover:from-primary group-hover:to-secondary group-hover:text-white group-hover:shadow-md group-hover:scale-110">
                <i class="fas fa-plus"></i>
            </div>
        </div>
    </div>
</a>
`;
                            });

                        });
                } else {
                    popularRecent.classList.remove('hidden');
                    searchResults.classList.add('hidden');
                    renderRecentSearches();
                }
            });

            function fetchLatestProducts() {
                fetch(`/latest-products`)
                    .then(res => res.json())
                    .then(products => {
                        const container = document.querySelector('#popular-recent .space-y-2');
                        container.innerHTML = '';
                        products.forEach(product => {
                            container.innerHTML += `
                        <div class="flex items-center p-3 hover:bg-light-gray rounded-xl cursor-pointer transition-all">
                            <img src="/storage/app/public/${product.image}" class="h-10 w-10 rounded-lg object-cover mr-3" />
                            <span class="text-gray-700 font-medium">${product.name}</span>
                        </div>
                    `;
                        });
                    });
            }


            document.querySelectorAll('.latest-product').forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    searchInput.value = this.dataset.value;
                    searchInput.dispatchEvent(new Event('input'));
                });
            });


            if (searchButton) searchButton.addEventListener('click', openSearchDrawer);
            if (closeSearch) closeSearch.addEventListener('click', closeSearchDrawer);
            if (overlay) overlay.addEventListener('click', closeSearchDrawer);

            renderRecentSearches();





            document.addEventListener('keydown', (event) => {
                if ((event.metaKey || event.ctrlKey) && event.key === 'k') {
                    event.preventDefault();
                    openSearchDrawer();
                }
            });
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeSearchDrawer();
                }
            });

            document.querySelectorAll('.bg-gray-100.text-gray-700').forEach(tag => {
                tag.addEventListener('click', () => {
                    document.getElementById('search-input').value = tag.textContent.trim();
                    document.getElementById('search-input').focus();
                    const event = new Event('input', {
                        bubbles: true
                    });
                    document.getElementById('search-input').dispatchEvent(event);
                });
            });
        });
    </script>
</body>

</html>