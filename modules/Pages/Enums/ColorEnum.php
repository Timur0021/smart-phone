<?php

namespace Modules\Pages\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ColorEnum: string implements HasLabel, HasColor
{
    case ORANGE = 'ORANGE';
    case GREEN = 'GREEN';
    case BLUE = 'BLUE';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ORANGE => 'Оранжевий',
            self::GREEN => 'Зелений',
            self::BLUE => 'Синій',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::BLUE => 'info',
            self::GREEN => 'success',
            self::ORANGE => 'orange',
        };
    }

}
