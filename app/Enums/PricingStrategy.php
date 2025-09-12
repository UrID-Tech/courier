<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Str;

enum PricingStrategy: string implements HasLabel
{
    case Weight = 'weight';
    case Value = 'value';
    case Dimensions = 'dimensions';
    case WeightAndValue = 'weight+value';
    case WeightAndDimensions = 'weight+dimensions';
    case ValueAndDimensions = 'value+dimensions';
    case All = 'all';


    public static function default(): self
    {
        return self::Weight;
    }

    public function getLabel(): ?string
    {
        return Str::title($this->name);
    }
}
