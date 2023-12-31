<?php

namespace App\Providers;

use App\Telegram\Commands\HelpCommand;
use App\Telegram\Commands\MyBookingsCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\ViewBikesCommand;
use App\Telegram\Commands\ViewFullCardCommand;
use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Telegram::addCommands([
            StartCommand::class,
            ViewBikesCommand::class,
            MyBookingsCommand::class,
            HelpCommand::class,
            ViewFullCardCommand::class,
        ]);
    }

    public function register()
    {

    }
}
