<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\CallbackQuery;

class BotController extends Controller
{
    public function handleWebhook()
    {
        try {
            $update = Telegram::commandsHandler(true);
            $data = json_decode($update->callbackQuery->data ?? '[]', true);
            //Log::info('data', is_array($data) ? $data : [$data]);
            if (!empty($data['command'])) {
                Telegram::triggerCommand($data['command'], $update);
            }
            //Log::info('update', [$update]);
            return 'ok';
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
