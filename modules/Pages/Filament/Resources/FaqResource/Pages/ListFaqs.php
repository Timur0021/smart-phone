<?php

namespace Modules\Pages\Filament\Resources\FaqResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Pages\Filament\Resources\FaqResource;

class ListFaqs extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
