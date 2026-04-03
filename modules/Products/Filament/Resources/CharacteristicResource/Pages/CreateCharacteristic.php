<?php

namespace Modules\Products\Filament\Resources\CharacteristicResource\Pages;

use Modules\Products\Filament\Resources\CharacteristicResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCharacteristic extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CharacteristicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
