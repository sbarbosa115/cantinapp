<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'phone', 'lat', 'lon', 'address'];
}
