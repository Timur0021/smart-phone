<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class TitleDescriptionItem
{
    public static function make(): Block
    {
        return Block::make('title_description_item')
            ->label('Заголовок+Опис')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),
                TranslatableContainer::make(
                    Textarea::make('description')
                        ->label('Опис'),
                ),
            ]);
    }
}
