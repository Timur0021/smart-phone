<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class KeyValue
{
    public static function make(): Block
    {
        return Block::make('key_value')
            ->label(__('Ключ-значення'))
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('key')
                        ->label('Ключ'),
                ),

                TranslatableContainer::make(
                    TiptapEditor::make('value')
                        ->label('Значення')
                        ->columnSpanFull(),
                ),
            ]);
    }
}
