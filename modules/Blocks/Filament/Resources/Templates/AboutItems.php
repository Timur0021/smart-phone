<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class AboutItems
{
    public static function make(): Block
    {
        return Block::make('about-items')
            ->label('Про елементи')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                TranslatableContainer::make(
                    Textarea::make('description')
                        ->label('Опис'),
                ),

                TextInput::make('number')
                    ->label('Номер')
                    ->numeric(),
            ]);
    }
}
