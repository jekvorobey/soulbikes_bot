<?php

namespace App\Telegram\Commands;

use App\Models\Motorcycle;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class ViewFullCardCommand extends BaseCommand
{
    protected string $name = 'view_full_card';
    protected string $description = 'view motorcycle full card';

    public function handle()
    {

        $data = json_decode($this->update->callbackQuery->data ?? '[]', true);

        $page = $data['previous_page'] ?? 1;
        $motorcycleId = $data['motorcycle_id'] ?? null;

        $motorcycle = Motorcycle::query()->findOrFail($motorcycleId);

        Telegram::sendMediaGroup([
            'chat_id' => $this->update->getMessage()->getChat()->getId(),
            'media' => json_encode($motorcycle->getMedia()),
        ]);

        $this->replyWithMessage([
            'text' => $motorcycle->makeFullCardText(),
            'reply_markup' => $this->makeKeyboard($page, $motorcycleId),
        ]);
    }

    private function makeKeyboard(int $page, int $motorcycleId): Keyboard
    {
        $buttons = [];
        $buttons[] = Keyboard::inlineButton([
            'text' => '⬅️ Back to list',
            'callback_data' => json_encode([
                'command' => 'view_bikes',
                'page' =>  $page,
            ]),
        ]);
        $buttons[] = Keyboard::inlineButton([
            'text' => 'Book',
            'callback_data' => json_encode([
                'command' => 'book',
                'motorcycle_id' =>  $motorcycleId,
            ]),
        ]);
        return Keyboard::make()->inline()->row($buttons);
    }
}
