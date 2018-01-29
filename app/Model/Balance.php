<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'order_id', 'status'];
}
