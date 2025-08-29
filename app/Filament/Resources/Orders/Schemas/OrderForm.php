<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Services\PricingCalculator;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Closure;
use Illuminate\Support\Facades\Auth;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email(),
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                        TextInput::make('identification_number')
                            ->label('Identification'),
                        TextInput::make('address')
                    ]),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculatePrice($set, $get)),


                Select::make('origin_location_id')
                    ->relationship('origin', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculatePrice($set, $get)),

                Select::make('destination_location_id')
                    ->relationship('destination', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculatePrice($set, $get)),

                TextInput::make('weight')
                    ->numeric()
                    ->live()
                    ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculatePrice($set, $get)),

                TextInput::make('length')
                    ->numeric()
                    ->live()
                    ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculatePrice($set, $get)),

                TextInput::make('width')
                    ->numeric()
                    ->live()
                    ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculatePrice($set, $get)),

                TextInput::make('height')
                    ->numeric()
                    ->live()
                    ->afterStateUpdated(fn(Get $get, Set $set) => self::recalculatePrice($set, $get)),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('RWF'),

                Select::make('status')
                    ->label('Order Status')
                    ->selectablePlaceholder(false)
                    ->options(OrderStatus::class)
                    ->enum(OrderStatus::class)
                    ->default(OrderStatus::default()),

                Select::make('payment_status')
                    ->label('Payment Status')
                    //->options(PaymentStatus::forOrder())
                    ->options(PaymentStatus::class)
                    ->enum(PaymentStatus::class)
                    ->default(PaymentStatus::default()),

                TextInput::make('receiver_name')
                    ->required(),

                TextInput::make('receiver_email')
                    ->email()
                    ->default(null),

                TextInput::make('receiver_phone')
                    ->required(),

                TextInput::make('receiver_address')
                    ->default(null),

                TextInput::make('notes')
                    ->default(null),

                Toggle::make('requires_delivery_confirmation')
                    ->default(false),
            ]);
    }

    /**
     * Recalculate price using the PricingCalculator service
     */
    protected static function recalculatePrice(Set $set, Get $get): void
    {
        $from     = $get('origin_location_id');
        $to       = $get('destination_location_id');
        $category = $get('category_id');
        $weight   = $get('weight') ?? 0;
        $length   = $get('length') ?? 0;
        $width    = $get('width') ?? 0;
        $height   = $get('height') ?? 0;
        $price = 0.0;
        if ($from && $to && $category) {
            $price = app(PricingCalculator::class)->estimate(
                tenantId: Auth::user()->tenant_id,
                categoryId: $category,
                originId: $from,
                destinationId: $to,
                weight: (float) $weight,
                length: (float) $length,
                width: (float) $width,
                height: (float) $height

            );

            $set('price', $price);
        }
    }
}
