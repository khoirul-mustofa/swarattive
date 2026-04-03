<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PageStatusEnum: string implements HasLabel, HasColor
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PUBLISHED => 'Published',
            self::DRAFT => 'Draft',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PUBLISHED => 'success',
            self::DRAFT => 'gray',
        };
    }
}
