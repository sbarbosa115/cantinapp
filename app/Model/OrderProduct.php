<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    public function sides(): HasMany
    {
        return $this->hasMany(Side::class);
    }

    public function sidesAsString(): string
    {
        $sides = $this->hasMany(Side::class)->get();
        $result = [];

        foreach ($sides as $side) {
            if ($side->products()->get()->count()) {
                $result[] = $side->products()->get()->first()->name;
            }
        }

        return implode(',', $result);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
