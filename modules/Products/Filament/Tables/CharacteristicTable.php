<?php

namespace Modules\Products\Filament\Tables;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CharacteristicTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('name')
                    ->label('Назва')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereRaw('LOWER(name) LIKE ?', ['%' . mb_strtolower($search) . '%']);
                    }),
                TextColumn::make('categories.name')
                    ->label('Категорія')
                    ->getStateUsing(fn($record) => $record->categories->first()?->name ?? 'Без категорії')
                    ->sortable(),
                TextColumn::make('values')
                    ->label('К-сть значень')
                    ->getStateUsing(fn($record) => $record->values->count())
                    ->sortable(),
                ToggleIconColumn::make('active')
                    ->label('Статус')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
                ToggleIconColumn::make('show_in_filter')
                    ->label('Показувати в фільтрах')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
                ToggleIconColumn::make('show_in_product')
                    ->label('Показувати в товарі')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
