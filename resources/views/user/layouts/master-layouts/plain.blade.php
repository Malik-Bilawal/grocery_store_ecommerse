
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>

<style>

:root {
        --primary-color: #f97316;     
        --primary-hover: #ea580c;      
        --secondary-color: #eab308;    
        --secondary-hover: #ca8a04; 
        --accent-color: #16a34a;     
        --accent-hover: #15803d;       
        --text-on-primary: #000000;  
        --text-on-secondary: #000000;  
        --light-orange: #ffedd5;
        --dark-orange: #9a3412;
        --light-orange: #ffedd5;
        --light-bg: #f8fafc;
        --white: #ffffff;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-800: #1f2937;
        --text-on-primary: #ffffff;
        --text-on-secondary: #ffffff;
    
        --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        --gradient-secondary: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
    }
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: var(--secondary-color);
  border-radius: 9999px;
}

::-webkit-scrollbar-thumb {
  background: var(--primary-color);
  border-radius: 9999px;
  transition: background 0.3s;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--primary-color-hover, #555);
}

/* Firefox support */
* {
  scrollbar-width: thin;
  scrollbar-color: var(--primary-color) var(--secondary-color);
}

</style>

<!-- Google tag (gtag.js) -->



    <meta charset="UTF-8">
    <title>@yield('title', 'Page')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>




    @stack('style')
</head>

<body class="bg-body">
<div id="loader">
    <div class="spinner"></div>
</div>

<!-- Navbar -->
@include("user.layouts.partials.navbar");

@yield('content')


<!-- Footer -->
 @include('user.layouts.partials.footer')

<script>
  console.log('loader showing')
  window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    console.log('loader hiding')
    loader.style.display = 'none';
  });
</script>
<script src="{{ asset('js/app.js') }}"></script>

    @stack('script')
</body>
</html>
