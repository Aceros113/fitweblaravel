<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        // agrega más campos si tu tabla los tiene
    ];

    // Relación: un gimnasio tiene muchos usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
