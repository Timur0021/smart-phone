<?php

namespace Modules\Products\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Modules\Products\Filament\Forms\ValueForm;
use Modules\Products\Filament\Resources\ValueResource\Pages;
use Modules\Products\Filament\Resources\ValueResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Products\Filament\Tables\ValueTable;
use Modules\Products\Models\Value;

class ValueResource extends Resource
{
    use Translatable;

    protected static ?string $model = Value::class;

    protected static ?string $navigationIcon = 'fas-pen-to-square';

    protected static ?string $navigationGroup = 'Товари';

    protected static ?string $pluralModelLabel = 'Значення';

    protected static ?int $navigationSort = 15;

    protected static ?string $navigationLabel = 'Значення';

    protected static ?string $modelLabel = 'Значення';


    public static function form(Form $form): Form
    {
        return ValueForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ValueTable::configure($table);
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
            'index' => Pages\ListValues::route('/'),
            'create' => Pages\CreateValue::route('/create'),
            'edit' => Pages\EditValue::route('/{record}/edit'),
        ];
    }
}
