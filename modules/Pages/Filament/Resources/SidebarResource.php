<?php

namespace Modules\Pages\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Pages\Filament\Resources\SidebarResource\RelationManagers\PagesRelationManager;
use Modules\Pages\Models\Sidebar;

class SidebarResource extends Resource
{
    use Translatable;

    protected static ?string $model = Sidebar::class;

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?int $navigationSort = 8;

    protected static ?string $modelLabel = 'Сайдбар';

    protected static ?string $navigationIcon = 'fas-window-restore';

    public static function getPluralLabel(): string
    {
        return 'Сайдбар';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Назва'),
                Select::make('page_id')
                    ->label('Головна сторінка')
                    ->relationship('page', 'title', fn($query) => $query->where('status', true)->orderBy('title', 'ASC'))
                    ->preload(),
                Toggle::make('is_catalog')
                    ->label('Каталог')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Назва'),
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
         PagesRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'=>SidebarResource\Pages\ListSidebars::route('/'),
            'create'=>SidebarResource\Pages\CreateSidebar::route('/create'),
            'edit'=>SidebarResource\Pages\EditSidebar::route('/{record}/edit'),
        ];
    }
}
