<?php

namespace Modules\Products\Filament\Tables;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CategoryTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Назва')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereRaw('LOWER(name) LIKE ?', ['%' . mb_strtolower($search) . '%']);
                    }),
                TextColumn::make('parent.name')
                    ->label('Батьківська категорія')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product_count')
                    ->label('К-сть товарів')
                    ->sortable(),
                ToggleIconColumn::make('active')
                    ->label('Статус')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
                ToggleIconColumn::make('will_be_soon')
                    ->label('Скоро у продажу!')
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
