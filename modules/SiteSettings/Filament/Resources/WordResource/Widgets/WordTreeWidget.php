<?php

namespace Modules\SiteSettings\Filament\Resources\WordResource\Widgets;

use Filament\Forms\Components\TextInput;
use Modules\Products\Models\Category;
use Modules\SiteSettings\Models\Word;
use SolutionForest\FilamentTree\Widgets\Tree as TreeWidget;

class WordTreeWidget extends TreeWidget
{
    protected static string $model = Word::class;

    protected static int $maxDepth = 3;

    protected static ?string $parentColumn = null;

    protected ?string $treeTitle = 'Слова';

    protected bool $enableTreeTitle = true;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name'),
        ];
    }

    public function getViewFormSchema(): array
    {
        return [
            //
        ];
    }
}
