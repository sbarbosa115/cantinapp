<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BalanceService extends Facade
{
    protected static function getFacadeAccessor() {
        return 'balanceService';
    }
}