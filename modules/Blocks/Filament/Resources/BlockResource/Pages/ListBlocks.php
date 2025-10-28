<?php

namespace Modules\Blocks\Filament\Resources\BlockResource\Pages;

use Modules\Blocks\Filament\Resources\BlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlocks extends ListRecords
{
//    use ListRecords\Concerns\Translatable;

    protected static string $resource = BlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
