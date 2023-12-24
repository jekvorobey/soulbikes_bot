<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

/**
 * @property string $name - название
 * @property string $code - код
 */

class Muffler extends Model
{
    protected $table = 'mufflers';

    protected $fillable = [
        'name',
        'code',
    ];
}
