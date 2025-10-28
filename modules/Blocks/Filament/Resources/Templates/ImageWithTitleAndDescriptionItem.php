<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ImageWithTitleAndDescriptionItem
{
    public static function make(): Block
    {
        return Block::make('image_with_title_and_description_item')
            ->label('Заголовок з списком заголовків')
            ->schema([
                FileUpload::make('image')
                    ->label('Зображення')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),
                TranslatableContainer::make(
                    Textarea::make('description')
                        ->label('Опис'),
                ),
                TranslatableContainer::make(
                    TextInput::make('title_button')
                        ->label('Заголовок Кнопки'),
                ),
                TextInput::make('link_button')
                    ->label('Посилання Кнопки'),
            ]);
    }
}
