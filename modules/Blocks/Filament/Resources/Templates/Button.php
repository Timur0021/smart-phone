<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class Button
{
    public static function make(): Block
    {
        return Block::make('button')
            ->label('Кнопка')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('text')
                        ->label('Текст'),
                ),
                TranslatableContainer::make(
                    TextInput::make('link')
                        ->label('Посилання'),
                ),
            ]);
    }
}
