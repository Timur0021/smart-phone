<?php

namespace Modules\Pages\Filament\Resources\SliderResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DetachBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\LocaleSwitcher;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Products\Filament\Resources\ProductResource;

class ProductsRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'products';
    protected static ?string $title = 'Авто';
    protected static ?string $label = 'Авто';
    protected static ?string $pluralLabel = 'Авто';



    public function form(Form $form): Form
    {
        return ProductResource::form($form);
    }

    public function table(Table $table): Table
    {

        return ProductResource::table($table)
            ->reorderable('product_slider.sort_order')
            ->defaultSort('product_slider.sort_order')
            ->recordTitleAttribute('title')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->label('Прикріпити')
                    ->modalHeading('Прикріпити Товар')
                    ->color('info')
                    ->icon('heroicon-o-link')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['id', 'title', 'description', 'article', 'barcode']),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->bulkActions([
                DetachBulkAction::make(),
            ]);
    }
}
