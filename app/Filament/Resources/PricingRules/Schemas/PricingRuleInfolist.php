<?php

namespace App\Filament\Resources\PricingRules\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PricingRuleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('category.name'),
                TextEntry::make('origin.name'),
                TextEntry::make('destination.name'),
                TextEntry::make('base_price')
                    ->numeric(),
                TextEntry::make('price_per_kg')
                    ->numeric(),
                TextEntry::make('price_per_dimension')
                    ->numeric(),
                TextEntry::make('min_weight')
                    ->numeric(),
                TextEntry::make('max_weight')
                    ->numeric(),
                TextEntry::make('min_length')
                    ->numeric(),
                TextEntry::make('max_length')
                    ->numeric(),
                TextEntry::make('min_width')
                    ->numeric(),
                TextEntry::make('max_width')
                    ->numeric(),
                TextEntry::make('min_height')
                    ->numeric(),
                TextEntry::make('max_height')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
