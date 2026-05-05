<?php

namespace Modules\Products\Filament\Resources;

use Modules\Products\Filament\Forms\ProductForm;
use Modules\Products\Filament\Resources\ProductResource\Pages;
use Modules\Products\Filament\Resources\ProductResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Products\Models\Product;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'fas-bag-shopping';

    protected static ?string $navigationGroup = 'Товари';

    protected static ?string $pluralModelLabel = 'Товари';

    protected static ?int $navigationSort = 13;

    protected static ?string $navigationLabel = 'Товари';

    protected static ?string $modelLabel = 'Товари';

    public static function form(Form $form): Form
    {
        return ProductForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
