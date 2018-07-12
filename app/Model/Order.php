<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{

    protected $fillable = ['pickup_at', 'status', 'image_path', 'user_id', 'payment_method'];

    protected $dates = [
        'pickup_at','created_at','updated_at '
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('product_id', 'order_id', 'quantity', 'comment');
    }

    public function productsOrder(){
        return $this->hasMany(OrderProduct::class)->get();
    }

    public function getTotalQuantityOrder(){
        $result = $this->belongsToMany(Product::class)->withPivot('quantity')->pluck("quantity");
        return array_sum($result->toArray());
    }
}
