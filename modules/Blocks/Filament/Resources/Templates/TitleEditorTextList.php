<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class TitleEditorTextList
{
    public static function make(): Block
    {
        return Block::make('title_editor_text_list')
            ->label('Текстовий список редактора заголовків')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                Select::make('size')
                    ->label('Розмір')
                    ->options([
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                    ]),

                FileUpload::make('image')
                    ->label('Зображення')
                    ->disk('public')
                    ->directory('blocks')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),

                TranslatableContainer::make(
                    TiptapEditor::make('description_editor')
                        ->label('Редактор опису')
                        ->profile('default')
                        ->columnSpanFull(),
                ),
                Builder::make('text_items')
                    ->label('Текстові елементи')
                    ->blocks([
                        TextItem::make(),
                    ])->addActionLabel('Додати елемент'),
            ]);
    }
}
