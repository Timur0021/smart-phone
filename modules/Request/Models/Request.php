<?php

namespace Modules\Request\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Request\Enums\RequestStatus;
use Modules\Telegram\Contracts\TelegramInterface;

class Request extends Model implements TelegramInterface
{
    protected $table = 'requests';

    protected $fillable = [
        'phone',
        'request_status',
    ];

    public function adminUrl(): string
    {
        return config('app.url') . "/admin/requests";
    }

    public function telegramTitle(): ?string
    {
        return "Нова заявка #{$this->id}";
    }

    public function telegramFields(): array
    {
        return [
            "Телефон:"             => $this->phone,
            "Статус заявки:"    => RequestStatus::tryFrom($this->request_status)?->getLabel(),
            "Дата створення:"    => Carbon::parse($this->created_at)
                                            ->timezone('Europe/Kyiv')
                                            ->format("Y-m-d H:i"),
        ];
    }
}
