<?php

namespace App;

use App\Model\Balance;
use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static findOrFail($id)
 *
 * @property mixed id
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'restaurant_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            if (session()->has('restaurant_id')) {
                $query->where('restaurant_id', '=', session()->get('restaurant_id'));
            }
        });
        static::creating(function ($item) {
            if (!$item->restaurant_id) {
                $item->restaurant_id = session()->get('restaurant_id');
            }
        });
    }

    public function balances(): HasMany
    {
        return $this->hasMany(Balance::class)->where('status', '=', 'available');
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordReset($this, $token));
    }
}
