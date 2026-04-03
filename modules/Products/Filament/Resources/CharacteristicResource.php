<?php

namespace Modules\Products\Filament\Resources;

use Filament\Resources\Concerns\Translatable;
use Modules\Products\Filament\Forms\CharacteristicForm;
use Modules\Products\Filament\Resources\CharacteristicResource\Pages;
use Modules\Products\Filament\Resources\CharacteristicResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Products\Filament\Tables\CharacteristicTable;
use Modules\Products\Models\Characteristic;

class CharacteristicResource extends Resource
{
    use Translatable;

    protected static ?string $model = Characteristic::class;

    protected static ?string $navigationIcon = 'fas-bars';

    protected static ?string $navigationGroup = 'Товари';

    protected static ?string $pluralModelLabel = 'Характеристикі';

    protected static ?int $navigationSort = 14;

    protected static ?string $navigationLabel = 'Характеристикі';

    protected static ?string $modelLabel = 'Характеристикі';

    public static function form(Form $form): Form
    {
        return CharacteristicForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return CharacteristicTable::configure($table);
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
            'index' => Pages\ListCharacteristics::route('/'),
            'create' => Pages\CreateCharacteristic::route('/create'),
            'edit' => Pages\EditCharacteristic::route('/{record}/edit'),
        ];
    }
}
