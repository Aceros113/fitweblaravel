<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'date',
        'amount',
        'payment_method',
        'user_id',
        'membership_id',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function membership()
{
    return $this->belongsTo(Membership::class);
}

}
