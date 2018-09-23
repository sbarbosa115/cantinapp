<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'phone', 'domain', 'address'];

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['domain'] = str_slug($value);
    }
}
