<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;
use Filament\Forms\Components\Builder;

class SecondTitlesList
{
    public static function make(): Block
    {
        return Block::make('title_list')
            ->label('Заголовок Список')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title_three')
                        ->label('Заголовок Перший'),
                ),
                TranslatableContainer::make(
                    TextInput::make('title_for')
                        ->label('Заголовок Другий'),
                ),
                Select::make('input_type_item')
                    ->label('Тип першого заголовка')
                    ->options([
                        'text' => 'Текст',
                        'phone' => 'Телефон',
                        'email' => 'Емейл',
                    ])
                    ->default('text'),
            ]);
    }
}
