<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class IconTitleDescriptionItem
{
    public static function make(): Block
    {
        return Block::make('icon_title_description_item')
            ->label('Іконка, назва, опис')
            ->schema([
                FileUpload::make('icon')
                    ->label('Іконка')
                    ->disk('public')
                    ->directory('blocks/icons')
                    ->maxSize(\Modules\Blocks\Models\Block::MAX_FILE_SIZE),

                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Заголовок'),
                ),

                TranslatableContainer::make(
                    TiptapEditor::make('description_editor')
                        ->label('Опис')
                        ->columnSpanFull(),
                ),
            ]);
    }
}
