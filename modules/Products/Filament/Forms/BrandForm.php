<?php

namespace Modules\Products\Filament\Forms;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class BrandForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Головна інформація')
                    ->label('Головна інформація')
                    ->schema([
                        TextInput::make('name')
                            ->label('Назва')
                            ->live(true)
                            ->afterStateUpdated(function (Set $set, string $operation, ?string $state) {
                                if (!empty($state) && $operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->required(),
                        TextInput::make('slug')
                            ->label('Слаг')
                            ->hidden(function (string $operation) {
                                if ($operation === 'create') {
                                    return true;
                                }
                            })
                            ->required(),
                        TextInput::make('link')
                            ->label('Посилання'),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Фото')
                            ->columnSpanFull()
                            ->collection('image'),
                    ]),
                Group::make()
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Статус')
                            ->schema([
                                Toggle::make('active')
                                    ->label('Активний')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }
}
