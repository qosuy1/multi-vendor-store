<?php

use \Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProductController;

Route::group(
    ['as' => 'front.'],
    function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::resource('cart', CartController::class)->except('show', 'edit', 'create');
    }
);
