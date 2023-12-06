<?php

namespace App\Telegram\Commands;

use App\Models\Motorcycle;
use Telegram\Bot\Keyboard\Keyboard;

class ViewBikesCommand extends BaseCommand
{
    protected string $name = 'view_bikes';

    protected string $description = 'view bikes';

    public function handle()
    {
            /*$this->update
            $motorcycles = Motorcycle::paginate(10);*/


        $this->replyWithMessage([
            'text' => 'view_bikes_command',
        ]);
    }
}
