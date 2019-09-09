<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'allow_orders', 'welcome_text'];

    protected $casts = [
        'allow_orders' => 'boolean',
    ];

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
    }
}
