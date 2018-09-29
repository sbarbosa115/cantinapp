<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $guard = 'employee';

    protected $fillable = ['name', 'username', 'email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            $query->where('restaurant_id', '=', session('restaurant_id'));
        });
    }

    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = bcrypt($password);
        $this->attributes['restaurant_id'] = session('restaurant_id');
        $this->attributes['remember_token'] = str_random(128);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
