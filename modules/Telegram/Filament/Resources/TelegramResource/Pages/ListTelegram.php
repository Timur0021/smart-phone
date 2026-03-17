<?php

namespace Modules\Telegram\Filament\Resources\TelegramResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Telegram\Filament\Resources\TelegramResource;

class ListTelegram extends ListRecords
{
    protected static string $resource = TelegramResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
