<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Side extends Model
{
    protected $fillable = ['order_product_id', 'product_id', 'quantity', 'order_id'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            $query->where('restaurant_id', '=', session('restaurant_id'));
        });
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->get()->first();
    }
}
