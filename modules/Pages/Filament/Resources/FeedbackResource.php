<?php

namespace Modules\Pages\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Modules\Pages\Enums\FeedbackStatus;
use Modules\Pages\Filament\Forms\FeedbackForm;
use Modules\Pages\Filament\Resources\FeedbackResource\Pages;
use Modules\Pages\Filament\Tables\FeedbackTable;
use Modules\Pages\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\RatingTheme;

class FeedbackResource extends Resource
{
    use Translatable;

    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'fas-comment';

    protected static ?string $navigationGroup = 'Сторінки';

    protected static ?string $pluralModelLabel = 'Відгуки';

    protected static ?int $navigationSort = 10;

    protected static ?string $modelLabel = 'Відгуки';

    public static function form(Form $form): Form
    {
        return FeedbackForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return FeedbackTable::configure($table);
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
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
