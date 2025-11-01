
<?php

namespace Modules\Pages\Filament\Forms;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Фото'))
                    ->columns()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Фото')
                            ->columnSpanFull()
                            ->collection('image')
                            ->conversion('webp'),
                        TextInput::make('image_alt')
                            ->label('Фото Альт')
                            ->maxLength(255),
                        TextInput::make('image_title')
                            ->label('Фото Назва')
                            ->maxLength(255),
                    ]),
                Section::make(__('Головна'))
                    ->columns()
                    ->schema([
                        TextInput::make('title')
                            ->label('Назва')
                            ->maxLength(255)
                            ->hintAction(
                                Action::make('copyTitleToMetaTitle')
                                    ->icon('heroicon-m-clipboard')
                                    ->action(function (Set $set, $state) {
                                        $set('meta_title', $state);
                                        $set('meta_description', $state);
                                    })
                            )
                            ->required(),
                        TextInput::make('slug')
                            ->label('Слаг')
                            ->helperText(function (string $operation) {
                                if ($operation === 'create') {
                                    return 'Will be generated automatically if empty';
                                }
                            })
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Опис')
                            ->columnSpanFull(),
                        TinyEditor::make('content')
                            ->label('Контент')
                            ->profile('default')
                            ->columnSpanFull(),

                        Toggle::make('status')
                            ->label('Активний')
                            ->onColor('success')
                            ->offColor('danger')->default(true),
                    ]),
                Section::make(__('Мета'))
                    ->columns()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Мета Назва'),
                        Textarea::make('meta_description')
                            ->label('Мета Опис'),
                    ]),
            ]);
    }
}
