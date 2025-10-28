<?php

namespace Modules\Pages\Filament\Resources\SidebarResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Pages\Filament\Resources\FooterResource;
use Modules\Pages\Filament\Resources\SidebarResource;

class EditSidebar extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = SidebarResource::class;

    public function getTitle(): string
    {
        $recordName = $this->record->name;
        return "Змінити Сайдбар {$recordName}";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
