<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //use HasFactory;

    //protected $fillable = ['email', 'password'];

    //protected $hidden = ['password'];
    public function login()
{
    return $this->morphOne(Login::class, 'loginable');
}

public function gym()
{
    return $this->hasOne(Gym::class, 'admin_id');
}
}

