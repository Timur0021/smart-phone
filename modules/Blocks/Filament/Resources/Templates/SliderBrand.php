<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class SliderBrand
{
    public static function make(): Block
    {
        return Block::make('slider_brand')
            ->label('Слайдер Брендів')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),
                TranslatableContainer::make(
                    TextInput::make('text')
                        ->label('Текст кнопки'),
                ),
                TranslatableContainer::make(
                    TextInput::make('link')
                        ->label('Посилання кнопки'),
                ),
            ]);
    }
}
