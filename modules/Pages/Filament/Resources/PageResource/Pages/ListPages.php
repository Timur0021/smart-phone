<?php

namespace Modules\Pages\Filament\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Pages\Filament\Resources\PageResource;

class ListPages extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
