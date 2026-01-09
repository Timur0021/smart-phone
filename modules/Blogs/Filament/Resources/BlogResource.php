<?php

namespace Modules\Blogs\Filament\Resources;

use Modules\Blogs\Filament\Forms\BlogForm;
use Modules\Blogs\Filament\Resources\BlogResource\Pages;
use Modules\Blogs\Filament\Resources\BlogResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Blogs\Filament\Tables\BlogTable;
use Modules\Blogs\Models\Blog;
use Filament\Resources\Concerns\Translatable;

class BlogResource extends Resource
{
    use Translatable;

    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'fas-file-fragment';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationGroup = 'Блог';

    protected static ?string $navigationLabel = 'Блог';

    protected static ?string $label = 'Блог';

    protected static ?string $pluralModelLabel = 'Блог';

    public static function form(Form $form): Form
    {
        return BlogForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return BlogTable::configure($table);
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
