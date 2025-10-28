<?php

namespace Modules\Blocks\Filament\Resources\Templates;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\TiptapEditor;
use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

class RentalConditionsItems
{
    public static function make(): Block
    {
        return Block::make('rental_conditions_items')
            ->label('Елементи умов прокату')
            ->schema([
                TranslatableContainer::make(
                    TextInput::make('title')
                        ->label('Назва'),
                ),
                TranslatableContainer::make(
                    TiptapEditor::make('text_first')
                        ->label('Опис перший')
                ),
                TranslatableContainer::make(
                    TiptapEditor::make('text_second')
                        ->label('Опис другий')
                ),
            ]);
    }
}
