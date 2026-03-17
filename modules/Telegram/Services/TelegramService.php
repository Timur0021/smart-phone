<?php

namespace Modules\Telegram\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Modules\Telegram\Contracts\TelegramInterface;
use Modules\Telegram\DTO\TelegramMessageDto;
use Modules\Telegram\Models\Telegram;
use Modules\Telegram\Traits\TelegramConfigTrait;
use Exception;

class TelegramService
{
    use TelegramConfigTrait;

    /**
     * @throws GuzzleException
     */
    public static function send(TelegramInterface $model): void
    {
        $client = new Client();
        $url = self::getUrl();
        $telegramUsers = Telegram::query()
            ->where('status', true)
            ->get();

        $message = "<b>{$model->telegramTitle()}</b>\n\n";

        $dto = new TelegramMessageDto(
            $model->telegramFields()
        );

        $message .= $dto->toTelegram();
        $message .= "\n\n<a href='{$model->adminUrl()}'>Перейти до адмінки</a>";

        foreach ($telegramUsers as $user) {
            try {
                $client->request('GET', $url, [
                    'query' => [
                        'chat_id' => $user->chat_id,
                        'text' => $message,
                        'parse_mode' => 'HTML',
                        'disable_web_page_preview' => true,
                    ]
                ]);
            } catch (Exception $exception) {
                Log::error($exception);
            }
        }
    }
}
