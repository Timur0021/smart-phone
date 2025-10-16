<?php

namespace Modules\Team\Filament\Resources\Admin\AdminResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Team\Filament\Resources\Admin\AdminResource;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
