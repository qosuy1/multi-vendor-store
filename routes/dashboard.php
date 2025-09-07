<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;



Route::group(
    [
        'prefix' => 'dashboard',
        'as' => 'dashboard.',
        'middleware' => ['auth']
    ],
    function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('index');


        // automatice name : categories.
        // automatice prefix : /categories
        Route::resource('categories', CategoriesController::class);
    }
);

// Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function () {
// });
