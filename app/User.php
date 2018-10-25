<?php

namespace App;

use App\Model\Balance;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static findOrFail($id)
 * @property mixed id
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'restaurant_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            $query->where('restaurant_id', '=', session('restaurant_id'));
        });
        static::creating(function($item) {
            $item->restaurant_id = session('restaurant_id');
        });
    }

    public function balances(): HasMany
    {
        return $this->hasMany(Balance::class)->where('status', '=', 'available');
    }
}
