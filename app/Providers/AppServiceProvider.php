<?php

namespace App\Providers;

use App\Services\BalanceService;
use App\Services\OrderService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('orderService', function()
        {
            return new OrderService();
        });

        App::bind('balanceService', function()
        {
            return new BalanceService();
        });
    }
}
