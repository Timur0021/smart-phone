<?php

namespace Modules\SiteSettings\Filament\Resources\TelegramResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\SiteSettings\Filament\Resources\TelegramResource;

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
