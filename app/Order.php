<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;

class Order extends Model
{
   /**
    * Return user's (customer) information.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Return all product.
    */
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('product_id', 'order_id', 'quantity', 'comment');
    }

    /**
    * Return the quantity order total items required.
    */
    public function getTotalQuantityOrder(){
        $result = $this->belongsToMany(Product::class)->withPivot('quantity')->pluck("quantity");
        return array_sum($result->toArray());
    }
}
