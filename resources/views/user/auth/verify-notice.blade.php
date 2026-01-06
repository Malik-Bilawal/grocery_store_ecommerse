@extends('user.layouts.master-layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-green-600 mb-4">Verify Your Email</h2>
        <p class="mb-4 text-center text-gray-700">
            We’ve sent a verification link to your email. Please check your inbox and click the link to verify your account.
        </p>

        @if(session('info'))
            <div class="mb-4 bg-blue-100 text-blue-800 p-3 rounded">
                {{ session('info') }}
            </div>
        @endif
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Resend Form -->
        <form method="POST" action="{{ route('verification.resend') }}" id="resendForm">
            @csrf
            <button type="submit" id="resendBtn" 
                    class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                Resend Verification Email
            </button>
            <p id="timerText" class="mt-2 text-sm text-gray-600 text-center"></p>
        </form>
    </div>
</div>

<script>
    const resendBtn = document.getElementById('resendBtn');
    const timerText = document.getElementById('timerText');
    let cooldown = 60; 
    let canResend = true;

    resendBtn.addEventListener('click', function(e) {
        if (!canResend) {
            e.preventDefault();
        } else {
            startCooldown();
        }
    });

    function startCooldown() {
        canResend = false;
        resendBtn.disabled = true;
        timerText.textContent = `You can resend email in ${cooldown} seconds`;

        const interval = setInterval(() => {
            cooldown--;
            timerText.textContent = `You can resend email in ${cooldown} seconds`;

            if (cooldown <= 0) {
                clearInterval(interval);
                resendBtn.disabled = false;
                timerText.textContent = '';
                cooldown = 60; 
                canResend = true;
            }
        }, 1000);
    }
</script>

@endsection
