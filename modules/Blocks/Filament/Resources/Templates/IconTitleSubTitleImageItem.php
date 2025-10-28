<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;
use Filament\Forms\Components\Builder;


class IconTitleSubTitleImageItem
{
    public static function make(): Block
    {
        return Block::make('icon_title_subtitle_image_item')
            ->label('Іконка, назва, під заголовок, фотка')
            ->schema([
                FileUpload::make('icon')
                    ->label('Іконка')
                    ->disk('public')
                    ->directory('blocks/icons')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),

                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                TranslatableContainer::make(
                    TextInput::make('subtitle')
                        ->label('Під Заголовок'),
                ),

                FileUpload::make('image')
                    ->label('Фото')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),

                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        ImageTitleSubtitleButtonItem::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
