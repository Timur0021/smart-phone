<?php

namespace Modules\SiteSettings\Filament\Resources\TextInSiteResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\SiteSettings\Filament\Resources\TextInSiteResource;

class ListTextInSites extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TextInSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
