<?php

namespace Modules\Blogs\Filament\Resources\BlogResource\Pages;

use Modules\Blogs\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlog extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
