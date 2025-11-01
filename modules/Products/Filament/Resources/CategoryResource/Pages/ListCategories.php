<?php

namespace Modules\Products\Filament\Resources\CategoryResource\Pages;

use Modules\Products\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Products\Filament\Resources\CategoryResource\Widgets\CategoryTreeWidget;

class ListCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CategoryResource::class;

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
            CategoryTreeWidget::class
        ];
    }
}
