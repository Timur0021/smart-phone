<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class TextList
{
    public static function make(): Block
    {
        return Block::make('text_list')
            ->label('Текстовий список')
            ->schema([
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                     TextItem::make(),
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
