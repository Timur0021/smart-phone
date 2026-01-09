<?php

namespace Modules\Blogs\Filament\Forms;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class BlogForm
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
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->label('Фото')
                                    ->columnSpanFull()
                                    ->preserveFilenames()
                                    ->collection('image')
                                    ->conversion('webp'),
                                TextInput::make('name')
                                    ->label('Назва')
                                    ->live(true)
                                    ->columnSpanFull()
                                    ->afterStateUpdated(function (Set $set, string $operation, ?string $state) {
                                        if (!empty($state) && $operation === 'create') {
                                            $set('slug', Str::slug($state));
                                        }
                                    })
                                    ->required(),
                                TextInput::make('slug')
                                    ->label('Слаг')
                                    ->columnSpanFull()
                                    ->hidden(function (string $operation) {
                                        if ($operation === 'create') {
                                            return true;
                                        }
                                    })
                                    ->required(),
                                Textarea::make('short_description')
                                    ->label('Короткий опис')
                                    ->columnSpanFull()
                                    ->rows(7),
                                TinyEditor::make('description')
                                    ->label('Опис')
                                    ->profile('default')
                                    ->columnSpanFull(),
                                Select::make('category_id')
                                    ->label('Категорії')
                                    ->native(false)
                                    ->preload()
                                    ->searchable()
                                    ->relationship('category', 'name'),
                                DatePicker::make('published_at')
                                    ->default(now()->format('Y-m-d'))
                                    ->label('Опубліковано'),
                            ]),
                        Tab::make('META')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Мета Назва'),
                                Textarea::make('meta_description')
                                    ->label('Мета Опис'),
                            ]),
                    ]),
                Group::make()
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Статус')
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
