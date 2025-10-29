<?php

namespace Modules\SiteSettings\Filament\Resources\SettingsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\SiteSettings\Filament\Resources\SettingsResource;

class ListSettings extends ListRecords
{
//    use ListRecords\Concerns\Translatable;

    protected static string $resource = SettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
