<?php

namespace Modules\Pages\Filament\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Pages\Filament\Resources\PageResource;

class EditPage extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = PageResource::class;

    public function getTitle(): string
    {
        $recordName = $this->record->title;
        return "Змінити Сторінку {$recordName}";
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
