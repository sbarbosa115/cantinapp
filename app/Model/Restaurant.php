<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'phone', 'lat', 'lon', 'address'];
}
