<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Str;

enum DeliveryStatus: string implements HasLabel, HasColor
{
    case InTransit = 'in-transit';
    case Delivered = 'delivered';

    public function getLabel(): ?string
    {
        return Str::headline($this->name);
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::InTransit => 'warning',
            self::Delivered => 'success',
        };
    }

    public static function default(): DeliveryStatus
    {
        return self::InTransit;
    }
}
