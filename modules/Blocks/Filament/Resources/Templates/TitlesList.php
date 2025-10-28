<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;
use Filament\Forms\Components\Builder;

class TitlesList
{
    public static function make(): Block
    {
        return Block::make('title_list')
            ->label('Заголовок Список')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title_one')
                        ->label('Заголовок Перший'),
                ),
                TranslatableContainer::make(
                    TextInput::make('title_two')
                        ->label('Заголовок Другий'),
                ),
                Select::make('input_type')
                    ->label('Тип першого заголовка')
                    ->options([
                        'text' => 'Текст',
                        'phone' => 'Телефон',
                        'email' => 'Емейл',
                    ])
                    ->default('text'),
                Builder::make('items')
                    ->label('Елементи')
                    ->blocks([
                        SecondTitlesList::make()
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
