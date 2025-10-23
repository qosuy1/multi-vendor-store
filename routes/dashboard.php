<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\OrderController;

Route::group(
    [
        'prefix' => 'dashboard',
        'as' => 'dashboard.',
        'middleware' => ['auth', 'check.user.type:admin,super_admin']
    ],
    function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('index');


        Route::get('/categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
        Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forseDelete'])->name('categories.force-delete');

        // automatice name : categories.
        // automatice prefix : /categories
        Route::resource('categories', CategoriesController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


    }
);

// Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function () {
// });
