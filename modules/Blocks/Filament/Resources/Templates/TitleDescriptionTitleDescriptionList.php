<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class TitleDescriptionTitleDescriptionList
{
    public static function make(): Block
    {
        return Block::make('title_description_title_description_item')
            ->label('Назва+Опис+Назва+Опис елементи')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                TranslatableContainer::make(
                    Textarea::make('description')
                        ->label('Опис'),
                ),

                Builder::make('title_description_items')
                    ->label('Заголовок+Опис елементи')
                    ->blocks([
                        TitleDescriptionItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
