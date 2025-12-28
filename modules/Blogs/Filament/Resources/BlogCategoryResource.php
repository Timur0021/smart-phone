<?php

namespace Modules\Blogs\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Modules\Blogs\Filament\Forms\BlogCategoryForm;
use Modules\Blogs\Filament\Resources\BlogCategoryResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Blogs\Filament\Tables\BlogCategoryTable;
use Modules\Blogs\Models\BlogCategory;

class BlogCategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = BlogCategory::class;

    protected static ?string $navigationIcon = 'fas-book-open';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Блог';

    protected static ?string $navigationLabel = 'Категорії';

    protected static ?string $label = 'Категорії';

    protected static ?string $pluralModelLabel = 'Категорії';

    public static function form(Form $form): Form
    {
        return BlogCategoryForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return BlogCategoryTable::configure($table);
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
            'index' => Pages\ListBlogCategories::route('/'),
            'create' => Pages\CreateBlogCategory::route('/create'),
            'edit' => Pages\EditBlogCategory::route('/{record}/edit'),
        ];
    }
}
