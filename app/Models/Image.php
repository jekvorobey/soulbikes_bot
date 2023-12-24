<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\FileUpload\InputFile;

/**
 * @property int $id - id
 * @property int $motorcycle_id - id мотоцикла
 * @property string $path - URL картинки
 * @property boolean $is_main - является ли картинкой для preview карточки
 */

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'motorcycle_id',
        'path',
        'created_at',
        'updated_at',
        'is_main',
    ];

    public function getInputFileForTelegram(): InputFile
    {
        return InputFile::create(
            Storage::disk('public')->path($this->path),
            'image_' .$this->id . '.jpg'
        );
    }

    public function getUrl(): string
    {
        return Storage::disk('public')->url($this->path);
    }
}
