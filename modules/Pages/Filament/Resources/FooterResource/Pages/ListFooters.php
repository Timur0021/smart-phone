<?php

namespace Modules\Pages\Filament\Resources\FooterResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Pages\Filament\Resources\FooterResource;

class ListFooters extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FooterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
