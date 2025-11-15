<?php

namespace Modules\Request\Filament\Resources;

use Modules\Request\Filament\Forms\RequestForm;
use Modules\Request\Filament\Resources\RequestResource\Pages;
use Modules\Request\Filament\Resources\RequestResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Request\Filament\Tables\RequestTable;
use Modules\Request\Models\Request;

class RequestResource extends Resource
{
    protected static ?string $model = Request::class;

    protected static ?string $navigationIcon = 'fas-bell';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationGroup = 'Заявки';

    protected static ?string $navigationLabel = 'Заявки';

    protected static ?string $modelLabel = 'Заявки';

    protected static ?string $pluralModelLabel = 'Заявки';


    public static function form(Form $form): Form
    {
        return RequestForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return RequestTable::configure($table);
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
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }
}
