<?php

namespace Modules\SiteSettings\Filament\Resources;

use App\Filament\Resources\TextInSiteResource\Pages;
use App\Filament\Resources\TextInSiteResource\RelationManagers;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\SiteSettings\Models\TextInSite;

class TextInSiteResource extends Resource
{
    use Translatable;

    protected static ?string $model = TextInSite::class;

    protected static ?string $navigationGroup = 'Налаштування Сайту';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Тексти на сайті';

    protected static ?string $modelLabel = 'Тексти на сайті';

    protected static ?string $navigationIcon = 'fas-indent';

    public static function getPluralLabel(): string
    {
        return 'Тексти на сайті';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns()
                    ->schema([
                        TextInput::make('text')
                            ->label('Текст')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('key')
                            ->label('Ключ')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('link')
                            ->label('Лінк')
                            ->url()
                            ->placeholder('http://zaferly.test/admin/'),
                        SpatieMediaLibraryFileUpload::make('file')
                            ->label('Файл')
                            ->collection('files'),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('text')
                    ->label('Текст')
                    ->limit(40)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('key')
                    ->label('Ключ')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('link')
                    ->label('Лінк')
                    ->searchable(),
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
            'index' => \Modules\SiteSettings\Filament\Resources\TextInSiteResource\Pages\ListTextInSites::route('/'),
            'create' => \Modules\SiteSettings\Filament\Resources\TextInSiteResource\Pages\CreateTextInSite::route('/create'),
            'edit' => \Modules\SiteSettings\Filament\Resources\TextInSiteResource\Pages\EditTextInSite::route('/{record}/edit'),
        ];
    }
}
