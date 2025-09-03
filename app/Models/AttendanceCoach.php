<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceCoach extends Model
{
    protected $table = 'attendances_coaches';

    protected $fillable = [
        'attendable_type',
        'attendable_id',
        'check_in',
        'check_out',
        'date',
    ];
}

