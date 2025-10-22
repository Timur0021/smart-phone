<?php

namespace Modules\Team\Filament\Resources\Branch\BranchResource\Pages;

use Modules\Team\Filament\Resources\Branch\BranchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBranches extends ListRecords
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
