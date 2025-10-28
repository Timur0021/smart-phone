<?php

namespace Modules\Pages\Filament\Resources;

use App\Filament\Resources\CategoryResource\RelationManagers\BadgesRelationManager;
use App\Filament\Resources\FooterResource\Pages;
use App\Filament\Resources\FooterResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Pages\Filament\Resources\FooterResource\RelationManagers\PagesRelationManager;
use Modules\Pages\Models\Footer;

class FooterResource extends Resource
{
    use Translatable;

    protected static ?string $model = Footer::class;

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'Футтер';

    protected static ?string $modelLabel = 'Футтер';

    protected static ?string $navigationIcon = 'fas-circle-down';

    public static function getPluralLabel(): string
    {
        return 'Футтер';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Назва')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Назва'),
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
            PagesRelationManager::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => FooterResource\Pages\ListFooters::route('/'),
            'create' => FooterResource\Pages\CreateFooter::route('/create'),
            'edit' => FooterResource\Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
