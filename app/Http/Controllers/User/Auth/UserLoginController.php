<?php
namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        Log::info('--- LOGIN ATTEMPT STARTED ---');
        Log::info('Request data:', $request->only('email'));
    
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
    
        Log::info('Validation passed.');
    
        $attempt = Auth::attempt($request->only('email', 'password'));
        Log::info('Auth attempt result:', ['success' => $attempt]);
    
        if ($attempt) {
    
            $user = Auth::user();
            Log::info('Authenticated user:', [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'verified' => $user->email_verified_at
            ]);
    
            if (!$user->hasVerifiedEmail()) {
                Log::warning('User email NOT verified.');
                Auth::logout();
                return redirect()->route('verification.notice')
                    ->with('error', 'Please verify your email before logging in.');
            }
    
            if ($user->role === 'admin') {
                Log::info('Redirecting admin to admin.categories.index');
                return redirect()->route('admin.categories.index');
            }
    
            
            Log::info('Redirecting regular user to /');
            return redirect('/');
        }
    
        Log::warning('Auth FAILED. Invalid credentials.');
    
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
        public function logout()
    {
        Auth::logout();
        return redirect()->route('login.show');
    }
}