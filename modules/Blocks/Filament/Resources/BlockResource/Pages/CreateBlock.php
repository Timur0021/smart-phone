<?php

namespace Modules\Blocks\Filament\Resources\BlockResource\Pages;

use Illuminate\Database\Eloquent\Model;
use Modules\Blocks\Filament\Resources\BlockResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Blocks\Traits\CreateRecord\FixTranslatablePlugin;

class CreateBlock extends CreateRecord
{
//    use CreateRecord\Concerns\Translatable;

    protected static string $resource = BlockResource::class;

//    protected function getHeaderActions(): array
//    {
//        return [
//            Actions\LocaleSwitcher::make(),
//        ];
//    }
}
