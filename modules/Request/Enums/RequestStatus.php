<?php

namespace Modules\Request\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum RequestStatus: string implements HasLabel, HasColor, HasIcon
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public static function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $case) => [$case->value => $case->getLabel()])
            ->toArray();
    }


    public function getLabel(): ?string
    {
        return match ($this) {
            self::NEW => 'Новий',
            self::IN_PROGRESS => 'В обробці',
            self::COMPLETED => 'Опрацьовано',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::NEW => 'warning',
            self::IN_PROGRESS => 'info',
            self::COMPLETED => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NEW => 'fas-plus-circle',
            self::IN_PROGRESS => 'fas-spinner',
            self::COMPLETED => 'fas-check',
        };
    }
}
