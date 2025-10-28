<?php

namespace Modules\Pages\Filament\Resources\FooterResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Pages\Filament\Resources\FooterResource;

class EditFooter extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FooterResource::class;

    public function getTitle(): string
    {
        $recordName = $this->record->name;
        return "Змінити Футтер {$recordName}";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
