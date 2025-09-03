<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Coach extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'phone_number',
        'birth_date',
        'gyms_id',
    ];

    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class, 'gyms_id');
    }

}

