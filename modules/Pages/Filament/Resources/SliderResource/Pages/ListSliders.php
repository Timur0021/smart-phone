<?php

namespace Modules\Pages\Filament\Resources\SliderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Pages\Filament\Resources\SliderResource;

class ListSliders extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
