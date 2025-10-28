<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ColorPickerColor
{
    public static function make(): Block
    {
        return Block::make('color_picker')
            ->label('Кнопка для вибору кольору')
            ->schema([
                ColorPicker::make('color')
                    ->label('Колір'),
            ]);
    }
}
