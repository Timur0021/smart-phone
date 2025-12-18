<?php

namespace Modules\Notification\Filament\Resources\SubscribeResource\Pages;

use Modules\Notification\Filament\Resources\SubscribeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubscribes extends ListRecords
{
    protected static string $resource = SubscribeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
