<?php

namespace Modules\Notification\Filament\Resources\SubscribeResource\Pages;

use Modules\Notification\Filament\Resources\SubscribeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubscribe extends EditRecord
{
    protected static string $resource = SubscribeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
