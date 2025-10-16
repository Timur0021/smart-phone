<?php

namespace Modules\Team\Filament\Resources\Admin;

use App\Filament\Resources\Admin\AdminResource\Pages;
use App\Filament\Resources\Admin\AdminResource\RelationManagers;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\Team\Filament\Resources\Admin\AdminResource\Pages\CreateAdmin;
use Modules\Team\Filament\Resources\Admin\AdminResource\Pages\EditAdmin;
use Modules\Team\Filament\Resources\Admin\AdminResource\Pages\ListAdmins;
use Modules\Team\Models\User;
use Rawilk\FilamentPasswordInput\Password;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'fas-user-tie';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Адміністратори';

    protected static ?string $modelLabel = 'Адміністратори';

    protected static ?string $navigationGroup = 'Команда';

    protected static ?string $slug = 'users';

    public static function getPluralLabel(): string
    {
        return 'Користувачі';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Головна інформація')
                    ->description('Створення Адміна')
                    ->schema([
                        TextInput::make('name')
                            ->label('Ім\'я')
                            ->required(),
                        TextInput::make('email')
                            ->label('Емейл')
                            ->type('email')
                            ->unique(
                                table: User::class,
                                column: 'email',
                                ignoreRecord: true,
                            )
                            ->validationMessages([
                                'unique' => 'Користувач з таким емейлом вже існує.',
                            ])
                            ->required()
                            ->placeholder('Enter Email'),
                        Password::make('password')
                            ->label('Пароль')
                            ->required()
                            ->rules('min:8')
                            ->placeholder('Enter Password'),
                        Select::make('roles')
                            ->label('Роль')
                            ->preload()
                            ->relationship('roles', 'name')
                    ])->columnSpan(2)->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()->whereHas('roles', function ($query) {
                    $query->whereIn('name', ['super_admin', 'admin']);
                })
            )
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Ім\'я')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Емейл')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Роль'),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->preload()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }
}
