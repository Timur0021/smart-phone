<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Modules\Telegram\Models\Telegram;

class TelegramAddUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:add-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Telegram bot updates and add new users to telegram table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();
        $url = 'https://api.telegram.org/bot'.config('telegram.bot_token').'/getUpdates';

        $response = $client->request('GET', $url);

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $data = json_decode($body, true);
            $ids = [];

            foreach ($data['result'] as $item) {
                if (array_key_exists('message', $item)) {
                    $chatId = $item["message"]["chat"]["id"];

                    if (!in_array($chatId, $ids)) {
                        $tg = Telegram::query()
                            ->where('chat_id', $chatId)
                            ->first();

                        if (!$tg) {
                            $newUser = new Telegram();
                            $newUser->chat_id = $chatId;
                            $newUser->user_name = $item["message"]["chat"]["username"];
                            $newUser->first_name = $item["message"]["chat"]["first_name"];
                            $newUser->save();
                        }
                    }
                }
            }
        }
    }
}
