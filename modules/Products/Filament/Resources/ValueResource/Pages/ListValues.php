<?php

namespace Modules\Products\Filament\Resources\ValueResource\Pages;

use Modules\Products\Filament\Resources\ValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValues extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = ValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
