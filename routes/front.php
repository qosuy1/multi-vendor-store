<?php

use \Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProductController;

Route::group(
    ['as' => 'front.'],
    function () {

        // Home
        Route::get('/', [HomeController::class, 'index'])->name('home');
        // Products
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::resource('cart', CartController::class)->except('show', 'edit', 'create');
        // Checkout
        Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.show');
        Route::post('/checkout' , [CheckoutController::class , 'store'])->name('checkout.store');
    }
);
