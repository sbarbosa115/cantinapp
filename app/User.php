<?php

namespace App;

use App\Model\Balance;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the current balance relationship.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances(){
        return $this->hasMany(Balance::class)->where("status", "=", "available");
    }
}
