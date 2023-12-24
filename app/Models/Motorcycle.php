<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * @property int $id - id
 * @property int $category_id - id категории
 * @property int $brand_id - id марки
 * @property string model - модель
 * @property int $engine_volume - объем двигателя
 * @property int $cylinders_count - количество цилиндров
 * @property int $horse_power - количество лошадиных сил
 * @property int $year - год выпуска
 * @property int $mileage - пробег
 * @property int $tires_id - id шин
 * @property int $muffler_type_id - id типа глушителя
 * @property string $insurance - страховка
 * @property string $description - описание
 * @property int $status - статус
 * @property-read Category $category - категория
 * @property-read Brand $brand - марка
 * @property-read Muffler $muffler - глушитель
 * @property-read Tire $tires - шины
 */

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function tires(): BelongsTo
    {
        return $this->belongsTo(Tire::class, 'tires_id', 'id');
    }

    public function muffler(): BelongsTo
    {
        return $this->belongsTo(Muffler::class, 'muffler_type_id', 'id');
    }

    public function makePreviewCaption(): string
    {
        $caption = "Category: {$this->category->name}\n";
        $caption .= "Engine: {$this->engine_volume}cc, {$this->cylinders_count} cylinders\n";
        $caption .= "Power: {$this->horse_power}h.p.\n";
        return $caption;
    }

    public function makeFullCardText(): string
    {
        $this->load('category');
        $text = "Category: {$this->category->name}\n";
        $text .= "Engine: {$this->engine_volume}cc, {$this->cylinders_count} cylinders\n";
        $text .= "Power: {$this->horse_power}h.p.\n";
        if ($this->mileage) {
            $text .= "Mileage: {$this->mileage}\n";
        }
        if ($this->tires_id) {
            $this->load('tires');
            Log::info('motorcycle tires', $this->toArray());
            $text .= "Tires: {$this->tires->name}\n";
        }
        if ($this->muffler_type_id) {
            $this->load('muffler');
            Log::info('motorcycle muffler', $this->toArray());
            $text .= "Muffler: {$this->muffler->name}\n";
        }
        if ($this->description) {
            $text .= "\n{$this->description}";
        }
        return $text;
    }

    public function getMedia(): array
    {
        $media = [];

        /** @var Collection|Image[] $images */
        $images = Image::query()->where('motorcycle_id', $this->id)->get();

        foreach ($images as $image) {
            $media[] = [
                'type'  => 'photo',
                'media' => $image->getUrl(),
            ];
        }
        return $media;
    }

    public function getPreviewData(): array
    {
        return [

        ];
    }
}
