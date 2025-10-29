<?php

namespace Modules\SiteSettings\Filament\Resources;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Modules\SiteSettings\Filament\Resources\WordResource\Pages;
use Modules\SiteSettings\Filament\Resources\WordResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\SiteSettings\Models\Word;
use Filament\Resources\Concerns\Translatable;


class WordResource extends Resource
{
    use Translatable;

    protected static ?string $model = Word::class;

    protected static ?string $navigationIcon = 'fas-file-word';

    protected static ?string $navigationGroup = 'Налаштування Сайту';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Слова';

    protected static ?string $modelLabel = 'Слова';

    protected static ?string $pluralModelLabel = 'Слова';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Пошукове слово')
                            ->required(),
                        TextInput::make('link')
                            ->label('Посилання')
                            ->nullable(),
                        Toggle::make('active')
                            ->label('Статус')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Назва')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('link')
                    ->label('Посилання')
                    ->searchable()
                    ->sortable(),
                ToggleIconColumn::make('active')
                    ->label('Статус')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWords::route('/'),
            'create' => Pages\CreateWord::route('/create'),
            'edit' => Pages\EditWord::route('/{record}/edit'),
        ];
    }
}
