<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class DescriptionEditor
{
    public static function make(): Block
    {
        return Block::make('description_editor')
            ->label('Редактор опису')
            ->schema([
                TranslatableContainer::make(
                    TinyEditor::make('description_editor')
                        ->label('Редактор опису')
                        ->profile('default')
                        ->columnSpanFull(),
                ),
            ]);
    }
}
