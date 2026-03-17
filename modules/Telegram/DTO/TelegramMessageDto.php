<?php

namespace Modules\Telegram\DTO;

class TelegramMessageDto
{
    public function __construct(protected array $fields)
    {
    }

    public function toTelegram(): string
    {
        return collect($this->fields)
            ->filter(fn($value) => filled($value))
            ->map(fn($value, $label) => "<b>{$label}</b> {$value}")
            ->implode("\n");
    }
}
