<?php

namespace Modules\Pages\Filament\Resources\FeedbackResource\Pages;

use Modules\Pages\Filament\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedback extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
