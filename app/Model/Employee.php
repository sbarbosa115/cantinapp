<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{

    use Notifiable;

    protected $guard = 'employee';


    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'birth_date', 'username', 'email', 'password'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }
}
