<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name - название
 * @property string $code - код
 */

class Tire extends Model
{
    protected $table = 'tires';

    protected $fillable = [
        'name',
        'code',
    ];
}
