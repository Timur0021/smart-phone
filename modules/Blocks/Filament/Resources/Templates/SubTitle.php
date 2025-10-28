<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class SubTitle
{
    public static function make(): Block
    {
        return Block::make('sub_title')
            ->label('Підзаголовок')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('sub_title')
                        ->label('Підзаголовок'),
                ),
                Select::make('size')
                    ->label('Розмір')
                    ->options([
                        'h3' => 'h3',
                    ])
            ]);
    }
}
