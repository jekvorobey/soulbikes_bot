<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotController extends Controller
{
    protected Api $telegram;
    public function __construct(Api $telegram)
    {
        $this->telegram = new Api(getenv('TELEGRAM_BOT_TOKEN'));
    }

    public function handleWebhook()
    {
        try {
            $update = Telegram::commandsHandler(true);
            Log::info('update', [$update]);
        } catch (\Exception $e) {
            Log::error('handleWebhook: ' . $e->getMessage());
        }
    }

    public function setWebhook(Request $request): JsonResponse
    {
        $domain =  $request->get('domain');

        $response = Telegram::setWebhook(['url' => $domain . '/api/telegram-webhook']);

        return Response()->json($response);
    }
}
