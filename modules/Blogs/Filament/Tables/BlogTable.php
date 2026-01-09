<?php

namespace Modules\Blogs\Filament\Tables;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BlogTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Фото')
                    ->collection('image')
                    ->circular()
                    ->conversion('webp'),
                TextColumn::make('name')
                    ->label('Назва')
                    ->url(fn($record) => "http://localhost:5173/blogs/{$record->slug}")
                    ->openUrlInNewTab()
                    ->searchable(query: function ($query, $search) {
                        $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search) . '%']);
                    })
                    ->limit(50),
                TextColumn::make('views_count')
                    ->label('Перегляди'),
                TextColumn::make('category.name')
                    ->label('Категорія')
                    ->sortable(),
                ToggleIconColumn::make('active')
                    ->label('Статус')
                    ->onIcon('heroicon-s-lock-open')
                    ->offIcon('heroicon-o-lock-closed'),
                TextColumn::make('published_at')
                    ->label('Опубліковано')
                    ->date()
                    ->sortable(),
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
