<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class Faq
{
    public static function make(): Block
    {
        return Block::make('faq')
            ->label(__('FAQ'))
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Назва'),
                ),
                Builder::make('items')
                    ->label('Елементи')
                ->blocks([
                    FaqItem::make(),
                ])->addActionLabel('Додати елемент'),
            ]);
    }
}
