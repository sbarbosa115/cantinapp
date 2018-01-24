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
}
