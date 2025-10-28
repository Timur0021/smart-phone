<?php

namespace Modules\Pages\Filament\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Pages\Filament\Resources\PageResource;

class CreatePage extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
