<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class MyBookingsCommand extends Command
{
    protected string $name = 'my bookings';

    protected string $description = 'my bookings command';

    public function handle()
    {

    }
}
