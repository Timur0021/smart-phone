<?php

namespace Modules\Team\Filament\Resources\Branch\BranchResource\Pages;

use Modules\Team\Filament\Resources\Branch\BranchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBranch extends EditRecord
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
