<?php

// ----------------------------------------------------------------------
// CRITICAL: CORRECTED IMPORTS
// ----------------------------------------------------------------------

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// ❌ Removed: use Illuminate\Support\Facades\Request; (Caused errors)
// ❌ Removed: use Illuminate\Foundation\Auth\EmailVerificationRequest; (Caused errors)

// CONTROLLER IMPORTS
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InfoController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\productPageController;
use App\Http\Controllers\User\CategoryPageController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Partial\NavbarController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\Checkout\CheckoutController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Categories\CategoryController;
use Illuminate\Http\Request; // ✅ Corrected: Use Request class for type-hint

// ----------------------------------------------------------------------
// AUTHENTICATION ROUTES
// ----------------------------------------------------------------------

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', [UserLoginController::class, 'index'])->name('login.show');
Route::post('login', [UserLoginController::class, 'login'])->name('login');
Route::post('logout', [UserLoginController::class, 'logout'])->name('logout');

Route::get('register', [UserRegisterController::class, 'index'])->name('register.show');
Route::post('register', [UserRegisterController::class, 'register'])->name('user.register');

// ----------------------------------------------------------------------
// EMAIL VERIFICATION ROUTES
// ----------------------------------------------------------------------

Route::get('/email/verify', function () {
    return view('user.auth.verify-notice');
})->name('verification.notice');

// EMAIL VERIFY ROUTE (Fixes: Request class used, logic confirmed)
Route::get('/email/verify/{id}/{hash}', function (Request $request) {

    $userId = $request->route('id');
    $hash   = $request->route('hash');

    Log::info('[EMAIL VERIFY] Verification attempt', [
        'user_id' => $userId,
        'hash'    => $hash,
        'time'    => now()
    ]);

    $user = User::find($userId); 

    if (!$user) {
        Log::warning('[EMAIL VERIFY] User not found', ['user_id' => $userId]);
        abort(404, 'User not found');
    }

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        Log::warning('[EMAIL VERIFY] Invalid hash', [
            'user_id' => $userId,
            'hash'    => $hash
        ]);
        abort(403, 'Invalid verification link');
    }

    if ($user->hasVerifiedEmail()) {
        return redirect()->route('home')->with('info', 'Email already verified.');
    }

    if ($user->markEmailAsVerified()) {
        event(new Verified($user));
    }
    
    $user->update(['is_approved' => true]);

    Auth::login($user);

    Log::info('[EMAIL VERIFY] User verified and logged in', ['user_id' => $user->id]);

    return redirect()->route('home')->with('success', 'Email verified successfully!');

})->middleware(['signed'])->name('verification.verify');

// EMAIL RESEND ROUTE (Fixes: Added 'auth' middleware)
Route::post('/email/resend', function (Request $request) {
    $user = Auth::user();

    // Since 'auth' middleware is applied, $user should not be null, but good practice to check if logic is moved
    if (!$user) {
        return redirect()->route('login')->with('error', 'You must be logged in to resend verification.');
    }

    if ($user->last_verification_sent && $user->last_verification_sent->diffInSeconds(now()) < 60) {
        return back()->with('error', 'Please wait 1 minute before resending.');
    }

    $user->sendEmailVerificationNotification();
    $user->update(['last_verification_sent' => now()]);

    return back()->with('success', 'Verification link resent!');
})->middleware(['auth'])->name('verification.resend'); // ⬅️ CRITICAL FIX

// ----------------------------------------------------------------------
// PASSWORD RESET ROUTES
// ----------------------------------------------------------------------

// Forgot Password Form
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

//RESET PASWORD
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// ----------------------------------------------------------------------
// APPLICATION/E-COMMERCE ROUTES
// ----------------------------------------------------------------------

// HOME 
Route::get('popular-products', [NavbarController::class, 'index']);
Route::get('/search-products', [NavbarController::class, 'search']);
Route::get('/filter-products', [ProductPageController::class, 'filterProducts']);

// Product detail page
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('review/store',[ProductController::class, 'reviewStore'])->name('reviews.store');
Route::post('/cart/add', [ProductController::class, 'store'])->name('cart.add');
Route::post('/buy-now', [ProductController::class, 'buyNow'])->name('buy-now');


Route::get('/latest-products', function() {
    return \App\Models\Product::latest()->take(5)->get(['id', 'name', 'image', 'slug']);
});

Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');


//PRODOCUT
Route::get('product', [productPageController::class, 'index'])->name('product');

//Contact
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');


//CATEGORY
Route::get('category', [CategoryPageController::class, 'index'])->name('category');


//CONFIRMATION
Route::get('/order/confirmation/{order}', [CheckoutController::class, 'confirmation'])
    ->name('order.confirmation');
Route::get('/order/invoice/{order}/download', [CheckoutController::class, 'downloadInvoice'])
    ->name('order.invoice.download');


//ABOUT
Route::get('about', [AboutController::class ,'index'])->name('about');
Route::get('info',[InfoController::class, 'index'])->name('info');