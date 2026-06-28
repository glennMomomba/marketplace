<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;


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
        view()->composer('*', function ($view) {
            $categories = \App\Models\Category::all();
            $shops = \App\Models\Shop::all();
            $cartCount   = DB::table('cart_product')->count(); 
            $ordersCount = \App\Models\Order::count();
            
            $view->with(compact('categories', 'shops', 'cartCount', 'ordersCount'));
        });
    }
}
