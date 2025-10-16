<?php

namespace Modules\Team\Filament\Resources\Admin\AdminResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Team\Filament\Resources\Admin\AdminResource;
use Modules\Team\Filament\Resources\Admin\AdminResource\Widgets\CountUsers;

class ListAdmins extends ListRecords
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CountUsers::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
