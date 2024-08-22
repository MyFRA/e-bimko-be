<?php

namespace App\Helpers;

class TelegramBotHelper
{
    public static function sendMessage($message)
    {
        $apiToken = config('app.TELEGRAM_BOT_API_TOKEN');

        $data = [
            'chat_id' => '@e_bimko_bot',
            'text' => $message,
            'parse_mode' => 'markdown'
        ];

        return file_get_contents('http://api.telegram.org/bot' . $apiToken . '/sendMessage?' . http_build_query($data));
    }
}
