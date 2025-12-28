<?php

namespace Modules\Blogs\Filament\Forms;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class BlogCategoryForm
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
                        ColorPicker::make('color')
                            ->label('Колір')
                            ->rgba(),
                    ]),
                Group::make()
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Статус')
                            ->columns(2)
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
