<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Code\Throwable;
use Telegram\Bot\Commands\Command;

abstract class BaseCommand extends Command
{
    protected function handleException(Throwable $exception): void
    {
        Log::error('', [$exception]);
    }
}
