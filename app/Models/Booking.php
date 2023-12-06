<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'motorcycle_id',
        'user_id',
        'date_from',
        'date_to',
        'status_id',
    ];

    public function motorcycle(): HasOne
    {
        return $this->hasOne(Motorcycle::class, 'motorcycle_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
