<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'discount',
        'start_date',
        'finish_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // En el modelo Membership
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
