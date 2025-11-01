<?php

namespace Modules\Pages\Filament\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PageTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Фото')
                    ->collection('image')
                    ->conversion('webp'),
                TextColumn::make('title')
                    ->label('Назва')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereRaw('LOWER(title) LIKE ?', ['%' . mb_strtolower($search) . '%']);
                    }),
                ToggleColumn::make('status')
                    ->label('Статус'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
