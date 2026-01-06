<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ContactMessagesController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Categories\CategoryController;
use App\Http\Controllers\Admin\Categories\SubCategoryController;



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {

    //CATGEORIES
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    //SUBCATEGORIES
    Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::post('subcategories/store', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::put('subcategories/update/{id}', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('subcategories/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');


    //PRODUCTS
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/get-subcategories/{category}', [ProductController::class, 'getSubcategories']);

    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    //USER MANAGEMENT
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //SLIDER MANAGEMENT
    Route::get('/hero-sliders', [SliderController::class,'index'])->name('sliders.index');
    Route::post('hero-sliders/store', [SliderController::class, 'store'])->name('hero-sliders.store');
    Route::put('hero-sliders/update/{heroSlider}', [SliderController::class, 'update'])->name('hero-sliders.update');
    Route::delete('hero-sliders/delete/{heroSlider}', [SliderController::class, 'destroy'])->name('hero-sliders.destroy');
   

    //ORDERS 
    Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class,'show'])->name('order.show');
    Route::put('/orders/{id}/status', [OrderController::class,'statusUpdate'])->name('orders.statusUpdate');


    //SALES MANAGEMENT
    //SALES MANAGEMENT
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
Route::put('/sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');
Route::delete('/sales/delete/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');
Route::get('/sales/active', [SalesController::class, 'active'])->name('sales.active');

//CONTACTMESSAGES
Route::get('contact', [ContactMessagesController::class, 'index'])->name('contact.index');
Route::get('contact/destroy/{id}', [ContactMessagesController::class, 'destroy'])->name('contact.destroy');

});