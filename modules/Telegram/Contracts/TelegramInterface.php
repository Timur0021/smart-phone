<?php

namespace Modules\Telegram\Contracts;

interface TelegramInterface
{
    public function adminUrl(): string;
    public function telegramTitle(): ?string;
    public function telegramFields(): array;
}
