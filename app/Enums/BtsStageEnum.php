<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BtsStageEnum: string implements HasLabel
{
    case PRE_PRODUCTION = 'pre_production';
    case ON_LOCATION = 'on_location';
    case POST_PRODUCTION = 'post_production';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PRE_PRODUCTION => 'Pre-Production',
            self::ON_LOCATION => 'On Location',
            self::POST_PRODUCTION => 'Post-Production',
        };
    }
}
