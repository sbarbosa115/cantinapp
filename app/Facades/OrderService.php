<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/16/2018
 * Time: 11:46 AM
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class OrderService extends Facade
{
    protected static function getFacadeAccessor() {

        return 'orderService';

    }
}