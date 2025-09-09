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


        Route::get('/categories/trash' , [CategoriesController::class , 'trash'])->name('categories.trash');
        Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forseDelete'])->name('categories.force-delete');

        // automatice name : categories.
        // automatice prefix : /categories
        Route::resource('categories', CategoriesController::class);
    }
);

// Route::middleware('auth')->as('dashboard.')->prefix('dashboard')->group(function () {
// });
