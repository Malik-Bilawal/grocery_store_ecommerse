<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ config('app.name', 'Grocery Store') }}</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js'])
     --}}
     <link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>

</head>
<body class="bg-background text-text">

    <nav class="bg-primary text-white p-4 flex justify-between">
        <a href="{{ url('/') }}" class="font-bold text-xl">Grocery Store</a>
        <div>
            @auth
                <a href="{{ route('home') }}" class="px-4">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4">Login</a>
                <a href="{{ route('user.register') }}" class="px-4">Register</a>
            @endauth
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>

    <footer class="bg-secondary text-black p-4 text-center">
        <p>&copy; {{ date('Y') }} Grocery Store. All rights reserved.</p>
    </footer>

</body>
</html>
