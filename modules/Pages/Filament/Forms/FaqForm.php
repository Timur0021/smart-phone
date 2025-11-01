<?php

namespace Modules\Pages\Filament\Forms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use FilamentTiptapEditor\TiptapEditor;

class FaqForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(1)
                    ->schema([
                        TextInput::make('question')
                            ->label('Питання')
                            ->required(),
                        TiptapEditor::make('answer')
                            ->label('Відповідь')
                            ->columnSpanFull()
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Фото')
                            ->columnSpanFull()
                            ->conversion('webp')
                            ->collection('image'),
                        Toggle::make('status')
                            ->label('Активний')
                            ->default(true),
                    ]),
            ]);
    }
}
