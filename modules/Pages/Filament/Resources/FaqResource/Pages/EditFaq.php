<?php

namespace Modules\Pages\Filament\Resources\FaqResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Pages\Filament\Resources\FaqResource;

class EditFaq extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = FaqResource::class;

    public function getTitle(): string
    {
        $recordName = $this->record->question;
        return "Змінити Питання {$recordName}";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
