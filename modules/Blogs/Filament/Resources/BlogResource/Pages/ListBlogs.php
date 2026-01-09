<?php

namespace Modules\Blogs\Filament\Resources\BlogResource\Pages;

use Modules\Blogs\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogs extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
