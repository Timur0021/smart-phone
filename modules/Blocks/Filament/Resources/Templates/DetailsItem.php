<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class DetailsItem
{
    public static function make(): Block
    {
        return Block::make('detail_item')
            ->label('Деталі елемента')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('label')
                        ->label('Назва елемента'),
                ),
                TranslatableContainer::make(
                    TextInput::make('description')
                        ->label('Опис'),
                ),
                FileUpload::make('image')
                    ->label('Зображення')
                    ->disk('public')
                    ->maxSize(\Modules\Blocks\Models\Block::MEDDIUM_FILE_SIZE)
                    ,
            ]);
    }
}
