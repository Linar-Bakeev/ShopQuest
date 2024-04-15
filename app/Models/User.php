<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{ use HasFactory, Notifiable;

    protected $fillable = ['login', 'password', 'last_name', 'first_name', 'email', 'role'];
    protected $hidden = [
        'password',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
