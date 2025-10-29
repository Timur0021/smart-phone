<?php

namespace Modules\SiteSettings\Filament\Resources\WordResource\Pages;

use Modules\SiteSettings\Filament\Resources\WordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\SiteSettings\Filament\Resources\WordResource\Widgets\WordTreeWidget;

class ListWords extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = WordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            WordTreeWidget::class
        ];
    }
}
