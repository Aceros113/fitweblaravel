<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Si usas cédula como clave primaria
    public $incrementing = false;
    protected $keyType = 'string'; // o 'integer' si es numérico

    protected $fillable = [
        'id', // Asegúrate de incluir el id aquí
        'name',
        'gender',
        'birth_date',
        'phone_number',
        'email',
        'state',
        'gym_id'
    ];

    // Relaciones
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
