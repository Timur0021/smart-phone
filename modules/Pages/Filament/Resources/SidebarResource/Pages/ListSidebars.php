<?php

namespace Modules\Pages\Filament\Resources\SidebarResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Pages\Filament\Resources\FooterResource;
use Modules\Pages\Filament\Resources\SidebarResource;

class ListSidebars extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SidebarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
