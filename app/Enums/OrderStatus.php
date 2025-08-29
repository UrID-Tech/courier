<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Illuminate\Support\Str;

enum OrderStatus: string implements HasLabel, HasColor
{
    case Pending = 'pending';
    case InTransit = 'in-transit';
    case Cancelled = 'cancelled';
    case Delivered = 'delivered';

    public function getLabel(): ?string
    {
        return Str::headline($this->name);
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::InTransit => 'warning',
            self::Delivered => 'success',
            self::Cancelled => 'danger',
        };
    }

    public static function default(): OrderStatus
    {
        return self::Pending;
    }
}
