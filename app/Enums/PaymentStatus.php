<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Illuminate\Support\Str;

enum PaymentStatus: string implements HasLabel, HasColor
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';
    case Paid = 'paid';

    public function getLabel(): ?string
    {
        return Str::headline($this->name);
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Paid => 'success',
            self::Completed => 'success',
            self::Failed => 'danger',
        };
    }

    public static function default(): PaymentStatus
    {
        return self::Pending;
    }

    public static function forOrder(): array
    {
        return array_filter(self::cases(), function (self $status) {
            return (
                in_array($status, [self::Pending, self::Paid])
            );
        });
    }

    public static function forOrderValues(): array
    {
        return array_map(
            fn(self $status) => $status->value,
            self::forOrder()
        );
    }

    public static function forPayment(): array
    {
        return array_filter(self::cases(), function (self $status) {
            return (
                in_array($status, [self::Pending, self::Completed, self::Completed])
            );
        });
    }
}
