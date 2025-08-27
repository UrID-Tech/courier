<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('tenant_id'),
                TextEntry::make('customer_id'),
                TextEntry::make('tracking_number'),
                TextEntry::make('category_id'),
                TextEntry::make('origin_location_id'),
                TextEntry::make('destination_location_id'),
                TextEntry::make('weight')
                    ->numeric(),
                TextEntry::make('length')
                    ->numeric(),
                TextEntry::make('width')
                    ->numeric(),
                TextEntry::make('height')
                    ->numeric(),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
