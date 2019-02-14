<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static removeUserBalance(\App\User $user, $product, \App\Model\Order $order)
 */
class BalanceService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'balanceService';
    }
}
