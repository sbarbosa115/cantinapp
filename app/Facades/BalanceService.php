<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static syncUserAndBalance($product, \App\Model\Order $order)
 */
class BalanceService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'balanceService';
    }
}
