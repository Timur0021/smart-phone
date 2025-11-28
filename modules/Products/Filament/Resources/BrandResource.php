<?php

namespace Modules\Products\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Modules\Products\Filament\Forms\BrandForm;
use Modules\Products\Filament\Resources\BrandResource\Pages;
use Modules\Products\Filament\Resources\BrandResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Products\Filament\Tables\BrandTable;
use Modules\Products\Models\Brand;

class BrandResource extends Resource
{
    use Translatable;

    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'fas-web-awesome';

    protected static ?string $navigationGroup = 'Товари';

    protected static ?string $pluralModelLabel = 'Бренди';

    protected static ?int $navigationSort = 13;

    protected static ?string $navigationLabel = 'Бренди';

    protected static ?string $modelLabel = 'Бренди';

    public static function form(Form $form): Form
    {
        return BrandForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return BrandTable::configure($table);
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}
