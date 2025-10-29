<?php

namespace Modules\SiteSettings\Filament\Resources\WordResource\Pages;

use Modules\SiteSettings\Filament\Resources\WordResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWord extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = WordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
