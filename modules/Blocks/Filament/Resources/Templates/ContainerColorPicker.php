<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ContainerColorPicker
{
    public static function make(): Block
    {
        return Block::make('container_color_picker')
            ->label('Вибір кольору контейнера')
            ->schema([
                ColorPicker::make('color')
                    ->label('Колір'),
                Toggle::make('is_container')
                    ->label('Контейнер'),
            ]);
    }
}
