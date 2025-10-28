<?php

namespace Modules\Pages\Filament\Resources\SidebarResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Pages\Filament\Resources\FooterResource;
use Modules\Pages\Filament\Resources\SidebarResource;

class CreateSidebar extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = SidebarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
