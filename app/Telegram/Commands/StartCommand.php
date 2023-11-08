<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'start command';

    public function handle()
    {
        $text = "Привет! Добро пожаловать в бот по аренде мотоциклов.";

        $this->replyWithMessage([
            'text' => $text,
        ]);
    }
}
