<?php

namespace Modules\Blocks\Filament\Resources\BlockResource\Pages;

use Illuminate\Database\Eloquent\Model;
use Modules\Blocks\Filament\Resources\BlockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Blocks\Models\Block;
use Modules\Blocks\Traits\EditRecord\FixTranslatablePlugin;

class EditBlock extends EditRecord
{
//    use EditRecord\Concerns\Translatable;

//    use FixTranslatablePlugin;

    protected static string $resource = BlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
//    protected function handleRecordUpdate(Model $record, array $data): Model
//    {
//        dd($data);
//    }
//    public function getBuilderName(): ?string
//    {
//        return 'content';
//    }
}
