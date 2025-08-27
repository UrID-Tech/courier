<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tenant_id')
                    ->required(),
                TextInput::make('customer_id')
                    ->required(),
                TextInput::make('tracking_number')
                    ->required(),
                TextInput::make('category_id')
                    ->required(),
                TextInput::make('origin_location_id')
                    ->required(),
                TextInput::make('destination_location_id')
                    ->required(),
                TextInput::make('weight')
                    ->numeric()
                    ->default(null),
                TextInput::make('length')
                    ->numeric()
                    ->default(null),
                TextInput::make('width')
                    ->numeric()
                    ->default(null),
                TextInput::make('height')
                    ->numeric()
                    ->default(null),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
