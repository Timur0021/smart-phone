<?php

namespace Modules\Pages\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Modules\Pages\Models\Faq;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class FaqResource extends Resource
{
    use Translatable;

    protected static ?string $model = Faq::class;

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationLabel = 'Часті Питання';

    protected static ?string $modelLabel = 'Часті Питання';

    protected static ?string $navigationIcon = 'fas-clipboard-question';

    public static function getPluralLabel(): string
    {
        return 'Часті Питання';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('question')
                            ->label('Питання')
                            ->required(),
                        TiptapEditor::make('answer')
                            ->label('Відповідь')
                            ->columnSpanFull()
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Фото')
                            ->columnSpanFull()
                            ->conversion('webp')
                            ->collection('image'),
                        Forms\Components\Toggle::make('status')
                            ->label('Активний')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('Питання'),
                Tables\Columns\TextColumn::make('answer')
                    ->limit(40)
                    ->label('Відповідь'),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Статус'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => FaqResource\Pages\ListFaqs::route('/'),
            'create' => FaqResource\Pages\CreateFaq::route('/create'),
            'edit' => FaqResource\Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
