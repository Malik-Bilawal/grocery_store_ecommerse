@extends('user.layouts.master-layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-green-600 mb-6">Reset Password</h2>

        @if(session('status'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
                {{ session('status') }}
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

        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full border-gray-300 rounded p-2 focus:border-green-600 focus:ring focus:ring-green-200"
                       placeholder="Enter your email">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">New Password</label>
                <input type="password" name="password" required 
                       class="w-full border-gray-300 rounded p-2 focus:border-green-600 focus:ring focus:ring-green-200"
                       placeholder="Enter new password">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" required 
                       class="w-full border-gray-300 rounded p-2 focus:border-green-600 focus:ring focus:ring-green-200"
                       placeholder="Confirm password">
            </div>

            <button type="submit" 
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                Reset Password
            </button>
        </form>

        <div class="mt-4 text-center text-sm">
            <a href="{{ route('login') }}" class="text-green-600 hover:underline">
                Back to Login
            </a>
        </div>
    </div>
</div>

@endsection
