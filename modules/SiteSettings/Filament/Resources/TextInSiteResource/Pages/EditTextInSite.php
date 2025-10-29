<?php

namespace Modules\SiteSettings\Filament\Resources\TextInSiteResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\SiteSettings\Filament\Resources\TextInSiteResource;

class EditTextInSite extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = TextInSiteResource::class;

    public function getTitle(): string
    {
        $recordName = $this->record->text;
        return "Змінити Текст - {$recordName}";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
