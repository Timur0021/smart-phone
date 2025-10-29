<?php

namespace Modules\SiteSettings\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\SiteSettings\Models\Telegram;

class TelegramResource extends Resource
{
    protected static ?string $model = Telegram::class;

    protected static ?string $navigationGroup = 'Налаштування Сайту';

    protected static ?string $pluralModelLabel = 'Телеграм користувачі';

    protected static ?string $modelLabel = 'Телеграм користувачі';

    protected static ?string $navigationIcon = 'fas-bell';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make()
                    ->columns()
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Ім\'я')
                            ->required(),
                        TextInput::make('user_name')
                            ->label('Username')
                            ->required(),
                        Forms\Components\Toggle::make('status')
                            ->label('Статус'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Telegram::query()->orderByDesc('created_at')
            )
            ->columns([
                TextColumn::make('first_name')
                    ->label('Ім\'я'),
                TextColumn::make('user_name')
                    ->label('Username'),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Статус'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => TelegramResource\Pages\ListTelegram::route('/'),
//            'create' => TelegramResource\Pages\CreateTelegram::route('/create'),
//            'edit' => TelegramResource\Pages\EditTelegram::route('/{record}/edit'),
        ];
    }
}
