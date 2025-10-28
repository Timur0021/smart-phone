<?php

namespace Modules\Pages\Filament\Resources\SliderResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Pages\Filament\Resources\SliderResource;

class EditSlider extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
