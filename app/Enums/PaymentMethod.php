<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Str;

enum PaymentMethod: string implements HasLabel
{
    case Cash = 'cash';
    case PalmKash = 'palm-kash';
    case FlutterWave = 'flutterwave';

    public function getLabel(): ?string
    {
        return Str::headline($this->name);
    }

    public static function default(): PaymentMethod
    {
        return self::Cash;
    }
}
