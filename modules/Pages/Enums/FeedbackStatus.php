<?php

namespace Modules\Pages\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum FeedbackStatus: string implements HasLabel, HasColor, HasIcon
{
    case PUBLISHED = 'published';
    case NOTPUBLISHED = 'not_published';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PUBLISHED => 'опубліковано',
            self::NOTPUBLISHED => 'не опубліковано',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::PUBLISHED => 'success',
            self::NOTPUBLISHED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PUBLISHED => 'fas-check',
            self::NOTPUBLISHED => 'fas-xmark',
        };
    }

}
