<?php

namespace Modules\Products\Filament\Forms;

use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ProductForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('navigation')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Головна інформація')
                            ->columns(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Назва')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('slug')
                                    ->label('Слаг')
                                    ->hidden(function (string $operation) {
                                        if ($operation === 'create') {
                                            return true;
                                        }
                                    })
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('price')
                                    ->label('Ціна')
                                    ->numeric(),
                                TextInput::make('old_price')
                                    ->label('Стара ціна')
                                    ->numeric(),
                                TextInput::make('quantity')
                                    ->label('Кількість')
                                    ->numeric(),
                                TextInput::make('discount')
                                    ->label('Знижка')
                                    ->numeric(),
                                SelectTree::make('categories')
                                    ->label('Категорія')
                                    ->multiple()
                                    ->relationship('categories', 'name', 'parent_id', fn($query) => $query->where('active', true)->orderBy('id'))
                                    ->enableBranchNode(),
                                Select::make('brand_id')
                                    ->label('Бренди')
                                    ->relationship('brand', 'name', fn($query) => $query->where('active', true))
                                    ->native(false)
                                    ->searchable()
                                    ->preload(),
                                Textarea::make('short_description')
                                    ->label('Короткий опис')
                                    ->rows(6)
                                    ->columnSpanFull(),
                                TinyEditor::make('description')
                                    ->label('Опис')
                                    ->profile('default')
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('META')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Мета Назва'),
                                Textarea::make('meta_description')
                                    ->label('Мета Опис')
                                    ->rows(8),
                            ]),
                ]),
                Group::make()
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Статус')
                            ->collapsible()
                            ->schema([
                                Grid::make(1)
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('active')
                                            ->label('Статус')
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->default(true),
                                    ])
                            ]),
                    ]),
            ]);
    }
}
