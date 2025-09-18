<?php

use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProductController;
use \Illuminate\Support\Facades\Route;

Route::group(
    ['as' => 'front.'],
    function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

    }
);
