<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cart\CartRepositories;
use App\Repositories\Cart\CartModelRepositories;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // bind the cart repositories
        $this->app->bind(CartRepositories::class, fn() => new CartModelRepositories());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
