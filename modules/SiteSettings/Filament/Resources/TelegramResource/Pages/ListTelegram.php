<?php

namespace Modules\SiteSettings\Filament\Resources\TelegramResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\SiteSettings\Filament\Resources\TelegramResource;

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
