<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Order;

class User extends Authenticatable
{
    protected $fillable = [
        'login',
        'password',
        'full_name',
        'phone_number',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
