<?php

namespace App\Telegram\Commands;

use App\Models\Image;
use App\Models\Motorcycle;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;

class ViewBikesCommand extends BaseCommand
{
    protected string $name = 'view_bikes';
    protected string $description = 'view bikes';

    public function handle()
    {
        Log::info('ViewBikesCommand');
        $data = json_decode($this->update->callbackQuery->data ?? '[]', true);
        Log::info('data', $data);
        $page = $data['page'] ?? 1;
        Log::info('page', [$page]);

        $motorcyclesPager = Motorcycle::query()->with('brand')->with('category')->paginate(1, ['*'], 'page', $page);
        /** @var Motorcycle $motorcycle */
        $motorcycle = $motorcyclesPager->items()[0];
        $image = $this->getImageForPreview($motorcycle);


        $this->replyWithPhoto([
            'photo' => $image,
            'caption' => $motorcycle->makePreviewCaption(),
            'reply_markup' => $this->makeKeyboard($page, $motorcyclesPager->total(), $motorcycle->id),
        ]);
    }

    private function makeKeyboard(int $page, int $total, int $motorcycleId): Keyboard
    {
        $buttons = [];
        if ($page > 1) {
            $buttons[] = Keyboard::inlineButton([
                'text' => '⬅️',
                'callback_data' => json_encode([
                    'command' => 'view_bikes',
                    'page' =>  $page - 1,
                ]),
            ]);
        }
        $buttons[] = Keyboard::inlineButton([
            'text' => 'View Full Card',
            'callback_data' => json_encode([
                'command' => 'view_full_card',
                'motorcycle_id' => $motorcycleId,
                'previous_page' => $page,
            ]),
        ]);
        if ($total !== $page) {
            $buttons[] = Keyboard::inlineButton([
                'text' => '➡️',
                'callback_data' => json_encode([
                    'command' => 'view_bikes',
                    'page' => $page + 1,
                ]),
            ]);
        }
        Log::info('buttons', $buttons);

        return Keyboard::make()->inline()->row($buttons);
    }

    private function getImageForPreview(Motorcycle $motorcycle): InputFile
    {
        /** @var Image $image */
        $image = Image::query()->where('motorcycle_id', $motorcycle->id)->where('is_main', true)->first();
        return $image->getInputFileForTelegram();
    }
}
