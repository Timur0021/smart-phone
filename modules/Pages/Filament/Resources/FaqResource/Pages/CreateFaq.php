<?php

namespace Modules\Pages\Filament\Resources\FaqResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Pages\Filament\Resources\FaqResource;

class CreateFaq extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
