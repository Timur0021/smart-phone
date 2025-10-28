<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class Title
{
    public static function make(): Block
    {
        return Block::make('title')
            ->label('Заголовок')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                )
                    ,
                Select::make('size')
                    ->label('Розмір')
                    ->options([
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                    ])
            ]);
    }
}
