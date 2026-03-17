<?php

namespace Modules\Telegram\Traits;

trait TelegramConfigTrait
{
    private static string $botToken;
    private static string $apiUrl;

    public static function init(): void
    {
        self::$botToken = config('telegram.bot_token');
        self::$apiUrl   = config('telegram.api_url');
    }

    private static function getUrl(string $method = 'sendMessage'): string
    {
        self::init();
        return self::$apiUrl . '/bot' . self::$botToken . '/' . $method;
    }
}
