<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class FaqItem
{
    public static function make(): Block
    {
        return Block::make('faq_item')
            ->label('Елемент FAQ')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('question')
                        ->label('Питання'),
                ),
                TranslatableContainer::make(
                    TextInput::make('answer')
                        ->label('Відповідь'),
                ),
                TranslatableContainer::make(
                    TiptapEditor::make('answer_text')
                        ->label('Відповідь в редакторі')
                ),

            ]);
    }
}
