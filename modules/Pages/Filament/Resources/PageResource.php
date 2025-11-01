<?php

namespace Modules\Pages\Filament\Resources;

use App\Filament\Resources\CategoryResource\RelationManagers\BadgesRelationManager;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Categories\Models\Category;
use Modules\Pages\Enums\ColorEnum;
use Modules\Pages\Filament\Forms\PageForm;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\BannersRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\BlocksRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\FaqsRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\FeedbackRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\SlidersRelationManager;
use Modules\Pages\Filament\Resources\PageResource\RelationManagers\TeachersRelationManager;
use Modules\Pages\Filament\Tables\PageTable;
use Modules\Pages\Models\Page;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Сторінки';

    protected static ?string $modelLabel = 'Сторінки';

    protected static ?string $navigationIcon = 'fas-file-lines';

    public static function getPluralLabel(): string
    {
        return 'Сторінки';
    }

    public static function form(Form $form): Form
    {
        return PageForm::configure($form);

    }

    public static function table(Table $table): Table
    {
        return PageTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            BlocksRelationManager::make(),
            FaqsRelationManager::make(),
            FeedbackRelationManager::make(),
            SlidersRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => PageResource\Pages\ListPages::route('/'),
            'create' => PageResource\Pages\CreatePage::route('/create'),
            'edit' => PageResource\Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
