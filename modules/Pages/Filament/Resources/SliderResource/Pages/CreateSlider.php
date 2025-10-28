<?php

namespace Modules\Pages\Filament\Resources\SliderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Pages\Filament\Resources\SliderResource;

class CreateSlider extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
