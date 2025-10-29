<?php

namespace Modules\SiteSettings\Filament\Resources;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\SiteSettings\Filament\Resources\SettingsResource\Pages\CreateSettings;
use Modules\SiteSettings\Filament\Resources\SettingsResource\Pages\EditSettings;
use Modules\SiteSettings\Filament\Resources\SettingsResource\Pages\ListSettings;
use Modules\SiteSettings\Filament\Resources\SettingsResource\RelationManagers;
use Modules\SiteSettings\Models\Setting;

class SettingsResource extends Resource
{
//    use Translatable;

    protected static ?string $model = Setting::class;
    protected static ?string $navigationGroup = 'Налаштування Сайту';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Налаштування';

    protected static ?string $modelLabel = 'Налаштування';

    protected static ?string $navigationIcon = 'fas-gear';

    public static function getPluralLabel(): string
    {
        return 'Налаштування';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->label('Назва')
                            ->maxLength(255)
                            ->required(),
                        Fieldset::make()
                            ->columns()
                            ->schema([
                                TextInput::make('key')
                                    ->label('Ключ')
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('value')
                                    ->label('Значення')
                                    ->maxLength(255)
                                    ->required(),
                                Toggle::make('is_new_window')
                                    ->label('Відкрити в новому вікні')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(false),
                                Toggle::make('show_in_site')
                                    ->label('Показувати на сайті')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(false),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('name')
                    ->label('Назва')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('key')
                    ->label('Ключ')
                    ->searchable()
                    ->copyable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Значення')
                    ->limit(40)
                    ->searchable()
                    ->sortable(),
                ToggleIconColumn::make('is_new_window')
                    ->label('Відкрити в новому вікні')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
                ToggleIconColumn::make('show_in_site')
                    ->label('Показувати на сайті')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
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
            'index' => ListSettings::route('/'),
            'create' => CreateSettings::route('/create'),
            'edit' => EditSettings::route('/{record}/edit'),
        ];
    }
}
