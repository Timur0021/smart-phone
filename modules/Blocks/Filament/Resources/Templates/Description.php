<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class Description
{
    public static function make(): Block
    {
        return Block::make('description')
            ->label(__('Опис'))
            ->schema([
                TranslatableContainer::make(
                    Textarea::make('description')
                        ->label(__('Опис')),
                ),
            ]);
    }
}
