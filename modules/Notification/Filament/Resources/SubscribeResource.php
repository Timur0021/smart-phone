<?php

namespace Modules\Notification\Filament\Resources;

use Modules\Notification\Filament\Forms\SubscribeForm;
use Modules\Notification\Filament\Resources\SubscribeResource\Pages;
use Modules\Notification\Filament\Resources\SubscribeResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Notification\Filament\Tables\SubscribeTable;
use Modules\Notification\Models\Subscribe;

class SubscribeResource extends Resource
{
    protected static ?string $model = Subscribe::class;

    protected static ?string $navigationIcon = 'fas-pen';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Пуші та Емейл розсилка';

    protected static ?string $navigationLabel = 'Підписка';

    protected static ?string $modelLabel = 'Підписка';

    protected static ?string $pluralModelLabel = 'Підписка';

    public static function form(Form $form): Form
    {
        return SubscribeForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return SubscribeTable::configure($table);
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
            'index' => Pages\ListSubscribes::route('/'),
            'create' => Pages\CreateSubscribe::route('/create'),
            'edit' => Pages\EditSubscribe::route('/{record}/edit'),
        ];
    }
}
