<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name - название
 * @property string $code - код
 * @property string $description - описание
*/

class Category extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
    ];
}
