<?php

namespace Modules\Products\Filament\Resources\ValueResource\Pages;

use Modules\Products\Filament\Resources\ValueResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateValue extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
