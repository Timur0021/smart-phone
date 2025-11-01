<?php

namespace Modules\Products\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Modules\Products\Filament\Forms\CategoryForm;
use Modules\Products\Filament\Resources\CategoryResource\Pages;
use Modules\Products\Filament\Resources\CategoryResource\RelationManagers;
use Modules\Products\Filament\Tables\CategoryTable;
use Modules\Products\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'fas-list';

    protected static ?string $navigationGroup = 'Товари';

    protected static ?string $pluralModelLabel = 'Категорії товарів';

    protected static ?int $navigationSort = 12;

    protected static ?string $navigationLabel = 'Категорії товарів';

    protected static ?string $modelLabel = 'Категорії товарів';

    public static function form(Form $form): Form
    {
        return CategoryForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return CategoryTable::configure($table);
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
