<?php

namespace Modules\SiteSettings\Filament\Resources\SettingsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\SiteSettings\Filament\Resources\SettingsResource;

class EditSettings extends EditRecord
{
//    use EditRecord\Concerns\Translatable;

    protected static string $resource = SettingsResource::class;

    public function getTitle(): string
    {
        $recordName = $this->record->name;
        return "Змінити Налаштування {$recordName}";
    }

    protected function getHeaderActions(): array
    {
        return [
//            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
