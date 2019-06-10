<?php

namespace App\Model\Product;

/**
 * @method static where(string $string, string $string1, string $string2)
 */
class Beverage extends ProductBase
{
    public const TYPE_BEVERAGE = 3;

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(static function ($query) {
            $query->where('type', '=', self::TYPE_BEVERAGE);
        });
    }

}
