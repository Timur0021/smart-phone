<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class TextItem
{
    public static function make(): Block
    {
        return Block::make('text_item')
            ->label('Текстовий елемент')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('text_item')
                        ->label('Текст'),
                ),

            ]);
    }
}
