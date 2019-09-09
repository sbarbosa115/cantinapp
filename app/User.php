<?php

namespace App;

use App\Model\Balance;
use App\Model\Order;
use App\Model\Restaurant;
use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        static::addGlobalScope(static function ($query) {
            if (session()->has('restaurant_id')) {
                $query->where('restaurant_id', '=', session()->get('restaurant_id'));
            }
        });
        static::creating(static function ($item) {
            if (!$item->restaurant_id) {
                $item->restaurant_id = session()->get('restaurant_id');
            }
        });
    }

    public function allBalances(): HasMany
    {
        return $this->hasMany(Balance::class);
    }

    public function balances(): HasMany
    {
        return $this->hasMany(Balance::class)->where('status',Balance::STATUS_AVAILABLE);
    }

    public function balancesDebt(): HasMany
    {
        return $this->hasMany(Balance::class)->where('status', Balance::STATUS_DEBT);
    }

    public function balancesSpent(): HasMany
    {
        return $this->hasMany(Balance::class)->where('status', Balance::STATUS_SPENT);
    }

    public function orders(string $paymentStatus): HasMany
    {
        return $this->hasMany(Order::class)->where('payment_status', $paymentStatus);
    }

    public function activeOrders(): HasMany
    {
        return $this->hasMany(Order::class)->whereIn('status', [
            Order::STATUS_CREATED, Order::STATUS_COOKED, Order::STATUS_COOKING
        ]);
    }

    public function canUserCreateOrders(): bool
    {
        return $this->activeOrders()->get()->count() === 0;
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordReset($this, $token));
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function allOrders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
