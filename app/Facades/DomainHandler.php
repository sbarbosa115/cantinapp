<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DomainHandler extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'domainHandler';
    }
}
