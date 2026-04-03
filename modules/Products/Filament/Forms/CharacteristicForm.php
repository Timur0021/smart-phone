<?php

namespace Modules\Products\Filament\Forms;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class CharacteristicForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Головна інформація')
                    ->columnSpan(1)
                    ->columns(2)
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
                        Select::make('categories')
                            ->label('Категорії')
                            ->multiple()
                            ->relationship(
                                'categories',
                                'name',
                                fn($query) => $query->where('active', true)->orderBy('name', 'DESC')
                            )
                            ->preload()
                            ->native(false)
                            ->columnSpanFull(),
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Статус')
                            ->collapsible()
                            ->schema([
                                Toggle::make('active')
                                    ->label('Активний')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true),
                                Toggle::make('show_in_filter')
                                    ->label('Показувати в фільтрах')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true),
                                Toggle::make('show_in_product')
                                    ->label('Показувати в товарі')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }
}
