<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Motorcycle extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'model',
        'engine_volume',
        'cylinders_count',
        'horse_power',
        'year',
        'mileage',
        'tires_id',
        'muffler_type_id',
        'insurance',
        'description',
        'status',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }

    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class);
    }

    public function tire(): HasOne
    {
        return $this->hasOne(Tire::class);
    }

    public function muffler(): HasOne
    {
        return $this->hasOne(Muffler::class);
    }

    public function getPreviewData(): array
    {
        return [

        ];
    }
}
