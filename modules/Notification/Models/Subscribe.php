<?php

namespace Modules\Notification\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Telegram\Contracts\TelegramInterface;

class Subscribe extends Model implements TelegramInterface
{
    protected $table = 'subscribes';

    protected $fillable = [
        'email',
    ];

    public function adminUrl(): string
    {
        return config('app.url') . "/admin/subscribes";
    }

    public function telegramTitle(): ?string
    {
        return "Новий користувач підписався";
    }

    public function telegramFields(): array
    {
        return [
            "Емейл:"         => $this->email,
            "Дата підписки:" => Carbon::parse($this->created_at)
                                        ->timezone('Europe/Kyiv')
                                        ->format("Y-m-d H:i"),
        ];
    }
}
