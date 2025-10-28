<?php

namespace Modules\Pages\Filament\Resources\FooterResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Pages\Filament\Resources\FooterResource;

class CreateFooter extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FooterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
