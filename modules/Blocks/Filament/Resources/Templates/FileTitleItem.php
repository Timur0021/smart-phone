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

class FileTitleItem
{
    public static function make(): Block
    {
        return Block::make('file_title_list')
            ->label('Заголовок + Файл Список')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title_first')
                        ->label('Заголовок Перший'),
                ),
                TranslatableContainer::make(
                    TextInput::make('title_second')
                        ->label('Заголовок Другий'),
                ),
                TranslatableContainer::make(
                    TextInput::make('content')
                        ->label('Контент'),
                ),
                Select::make('input_type')
                    ->label('Тип Контенту')
                    ->options([
                        'text' => 'Текст',
                        'phone' => 'Телефон',
                        'email' => 'Емейл',
                    ])
                    ->default('text'),
                TranslatableContainer::make(
                    TextInput::make('title_third')
                        ->label('Назва Файлу'),
                ),
                FileUpload::make('file')
                    ->label('Файл')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
                TranslatableContainer::make(
                    TextInput::make('title_forth')
                        ->label('Назва другого Файлу'),
                ),
                FileUpload::make('file_two')
                    ->label('Файл')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),
            ]);
    }
}
