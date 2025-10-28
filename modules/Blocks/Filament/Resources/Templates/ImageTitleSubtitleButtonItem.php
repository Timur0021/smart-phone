<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class ImageTitleSubtitleButtonItem
{
    public static function make(): Block
    {
        return Block::make('banners')
            ->label('Баннери')
            ->schema([
                FileUpload::make('image')
                    ->label('Зображення')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MEDDIUM_FILE_SIZE),
                FileUpload::make('imageMobile')
                    ->label('Зображення мобайл')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MEDDIUM_FILE_SIZE),
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                TranslatableContainer::make(
                    Textarea::make('description')
                        ->label('Опис'),
                ),


                Fieldset::make('Button')
                    ->schema([
                        TranslatableContainer::make(
                            TextInput::make('text')
                                ->label('Текст'),
                        ),

                        TranslatableContainer::make(
                            TextInput::make('link')
                                ->label('Посилання'),
                        ),
                    ])
                    ->label('Кнопка'),

            ]);
    }
}
