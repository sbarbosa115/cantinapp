<?php

namespace App\Providers;

use App\Services\BalanceService;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind('orderService', static function () {
            return new OrderService();
        });

        App::bind('balanceService', static function () {
            return new BalanceService();
        });

        App::bind('productService', static function () {
            return new ProductService();
        });
    }
}
