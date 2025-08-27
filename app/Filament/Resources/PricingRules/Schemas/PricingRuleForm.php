<?php

namespace App\Filament\Resources\PricingRules\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PricingRuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tenant_id')
                    ->required(),
                TextInput::make('category_id')
                    ->required(),
                TextInput::make('origin_location_id')
                    ->default(null),
                TextInput::make('destination_location_id')
                    ->default(null),
                TextInput::make('base_price')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('price_per_kg')
                    ->numeric()
                    ->default(null),
                TextInput::make('price_per_dimension')
                    ->numeric()
                    ->default(null),
                TextInput::make('min_weight')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_weight')
                    ->numeric()
                    ->default(null),
                TextInput::make('min_length')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_length')
                    ->numeric()
                    ->default(null),
                TextInput::make('min_width')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_width')
                    ->numeric()
                    ->default(null),
                TextInput::make('min_height')
                    ->numeric()
                    ->default(null),
                TextInput::make('max_height')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
