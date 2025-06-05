<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('navigation-menu', function ($view) {
            $cartCount = Cart::sum('quantity'); // Calculate total quantity of items in the cart
            $view->with('cartCount', $cartCount);
        });
    }
}
