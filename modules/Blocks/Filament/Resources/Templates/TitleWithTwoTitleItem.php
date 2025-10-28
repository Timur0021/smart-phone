<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class TitleWithTwoTitleItem
{
    public static function make(): Block
    {
        return Block::make('titles_item')
            ->label('Заголовок з списком заголовків')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        TitlesList::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
