<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Str;

enum VehicleCategory: string implements HasLabel, HasIcon
{
    case BUS = 'bus';
    case TRUCK = 'truck';
    case VAN = 'van';
    case CAR = 'car';
    case MOTORCYCLE = 'motorcycle';

    public static function default(): VehicleCategory
    {
        return self::BUS;
    }

    public function getLabel(): ?string
    {
        return Str::title($this->name);
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::BUS => 'lucide-bus',
            self::TRUCK => 'lucide-truck',
            self::VAN => 'lucide-van',
            self::CAR => 'lucide-car',
            self::MOTORCYCLE => 'lucide-motorcycle',
        };
    }
}
