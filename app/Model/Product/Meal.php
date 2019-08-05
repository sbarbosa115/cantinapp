<?php

namespace App\Model\Product;

use App\Model\Product;

/**
 * @method static where(string $string, string $string1, string $string2)
 */
class Meal extends Product
{
    public const TYPE_MEAL = 1;

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(static function ($query) {
            $query->where('type', '=', self::TYPE_MEAL);
        });
    }

}
