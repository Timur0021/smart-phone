<?php

namespace Modules\SiteSettings\Filament\Resources\SettingsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use Modules\SiteSettings\Filament\Resources\SettingsResource;

class CreateSettings extends CreateRecord
{
//    use Translatable;

    protected static string $resource = SettingsResource::class;

//    protected function getHeaderActions(): array
//    {
//        return [
//            Actions\LocaleSwitcher::make(),
//        ];
//    }
}
