<?php

namespace Modules\Team\Enums;

use Filament\Support\Contracts\HasLabel;

enum LocalesEnum: string implements HasLabel
{
    case UK = 'uk';
    case EN = 'en';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::UK => 'Українська',
            self::EN => 'Англійська',
        };
    }
}
