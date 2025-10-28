<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ColorBackground
{
    public static function make(): Block
    {
        return Block::make('color_background')
            ->label('Колір фону')
            ->schema([
                Select::make('background_color')
                    ->label('Колір фону')
                    ->options([
                        'blue' => 'Блакитний',
                        'yellow' => 'Жовтий',
                        'transparent' => 'Прозорий',
                        'gray' => 'Сірий',
                    ]),
                Toggle::make('is_container')->label('Контейнер'),
                Select::make('text_color')
                    ->label('Колір тексту')
                    ->options([
                        'blue' => 'Блакитний',
                        'black' => 'Чорний',
                    ]),
                Select::make('button_color')
                    ->label('Колір кнопки')
                    ->options([
                        'blue' => 'Блакитний',
                        'yellow' => 'Жовтий',
                    ]),
            ]);
    }
}
