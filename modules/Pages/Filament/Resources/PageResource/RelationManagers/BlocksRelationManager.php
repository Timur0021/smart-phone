<?php

namespace Modules\Pages\Filament\Resources\PageResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\LocaleSwitcher;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Blocks\Filament\Resources\BlockResource;
use Modules\Categories\Models\Category;
use Modules\Pages\Filament\Resources\BannerResource;

class BlocksRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'blocks';

    protected static ?string $title = 'Блоки';

    /**
     * @param Model<Category> $ownerRecord
     * @param string $pageClass
     * @return bool
     */

    public function form(Form $form): Form
    {
        return BlockResource::form($form);
    }

    public function table(Table $table): Table
    {
        return BlockResource::table($table)
            ->reorderable('page_block.sort_order')
            ->defaultSort('page_block.sort_order')
            ->recordTitleAttribute('name')
            ->headerActions([
                LocaleSwitcher::make(),
                AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->emptyStateHeading('Не знайдено блоків')
            ->emptyStateDescription('Натисніть "Прикріпити", щоб створити перший запис.');
    }
}
