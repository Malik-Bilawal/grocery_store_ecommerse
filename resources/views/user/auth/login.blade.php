@extends('user.layouts.master-layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-green-600 mb-6">Login</h2>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="mb-4 bg-blue-100 text-blue-800 p-3 rounded">
                {{ session('info') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- General error (like invalid credentials) -->
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full border-gray-300 rounded p-2 focus:border-green-600 focus:ring focus:ring-green-200">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full border-gray-300 rounded p-2 focus:border-green-600 focus:ring focus:ring-green-200">
            </div>

            <div class="mb-6 text-right">
                <a href="{{ route('password.request') }}" class="text-green-600 hover:underline text-sm">
                    Forgot your password?
                </a>
            </div>

            <button type="submit" 
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <div class="mt-4 text-center text-sm">
            Don't have an account? 
            <a href="{{ route('user.register') }}" class="text-green-600 hover:underline">Register</a>
        </div>
    </div>
</div>

@endsection
