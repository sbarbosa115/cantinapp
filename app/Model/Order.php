<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $fillable = ['pickup_at', 'status', 'image_path', 'user_id', 'payment_method'];

    protected $dates = [
        'pickup_at','created_at','updated_at '
    ];

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            $query->where('restaurant_id', '=', session('restaurant_id'));
        });
        static::creating(function($item) {
            $item->restaurant_id = session('restaurant_id');
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('product_id', 'order_id', 'quantity', 'comment');
    }

    public function productsOrder(): HasMany
    {
        return $this->hasMany(OrderProduct::class)->get();
    }

    /**
     * @return float|int
     */
    public function getTotalQuantityOrder()
    {
        $result = $this->belongsToMany(Product::class)->withPivot('quantity')->pluck("quantity");
        return array_sum($result->toArray());
    }
}
