<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Side extends Model
{
    protected $fillable = ['order_product_id', 'product_id', 'quantity', 'order_id'];
}
