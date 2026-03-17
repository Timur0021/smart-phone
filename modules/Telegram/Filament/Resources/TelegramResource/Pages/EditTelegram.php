<?php

namespace Modules\Telegram\Filament\Resources\TelegramResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Telegram\Filament\Resources\TelegramResource;

class EditTelegram extends EditRecord
{
    protected static string $resource = TelegramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
