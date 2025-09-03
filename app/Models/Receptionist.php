<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    public function login()
    {
        return $this->morphOne(Login::class, 'loginable');
    }
    
    public function gym()
    {
        return $this->hasOne(Gym::class, 'receptionist_id');
    }
}
