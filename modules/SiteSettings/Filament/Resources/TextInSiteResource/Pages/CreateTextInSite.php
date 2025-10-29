<?php

namespace Modules\SiteSettings\Filament\Resources\TextInSiteResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
use Modules\SiteSettings\Filament\Resources\TextInSiteResource;

class CreateTextInSite extends CreateRecord
{
    use Translatable;

    protected static string $resource = TextInSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
