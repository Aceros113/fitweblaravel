<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AttendanceUser extends Model
{

    protected $table = 'attendances_users';

    protected $fillable = [
        'user_id',       
        'check_in',
        'check_out',
        'date',
    ];

    /**
     * Relación: cada asistencia pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
