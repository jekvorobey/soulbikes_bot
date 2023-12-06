<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Keyboard\Keyboard;

class StartCommand extends BaseCommand
{
    protected string $name = 'start';
    protected string $description = 'start command';

    public function handle()
    {
        $keyboard = Keyboard::make()
            ->inline()
            ->row([
                Keyboard::inlineButton([
                    'text' => 'Просмотреть мотоциклы',
                    'callback_data' => '/view_bikes',
                ])
            ])
            ->row([
                Keyboard::inlineButton([
                    'text' => 'Мои бронирования',
                    'callback_data' => '/my_bookings',
                ])
            ])
            ->row([
                Keyboard::inlineButton([
                    'text' => 'Настройки',
                    'callback_data' => '/settings',
                ])
            ])
            ->row([
                Keyboard::inlineButton(['text' => 'Помощь']),
            ])
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->setSelective(false);

        $this->replyWithMessage([
            'text' => 'Добро пожаловать! Чем могу помо?',
            'reply_markup' => $keyboard
        ]);
    }
}
