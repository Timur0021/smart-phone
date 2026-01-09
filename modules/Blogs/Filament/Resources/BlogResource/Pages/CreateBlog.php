<?php

namespace Modules\Blogs\Filament\Resources\BlogResource\Pages;

use Modules\Blogs\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
