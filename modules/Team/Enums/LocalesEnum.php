<?php

namespace Modules\Team\Enums;

use Filament\Support\Contracts\HasLabel;

enum LocalesEnum: string implements HasLabel
{
    case UK = 'uk';
    case EN = 'en';
    case FR = 'fr';
    case DE = 'de';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::UK => 'Українська',
            self::EN => 'Англійська',
            self::FR => 'Французька',
            self::DE => 'Німецька',
        };
    }
}
