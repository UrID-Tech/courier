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
                TextEntry::make('customer.name'),
                TextEntry::make('tracking_number'),
                TextEntry::make('category.name'),
                TextEntry::make('origin.name'),
                TextEntry::make('destination.name'),
                TextEntry::make('receiver_name'),
                TextEntry::make('receiver_email'),
                TextEntry::make('receiver_phone'),
                TextEntry::make('weight')
                    ->numeric(),
                TextEntry::make('length')
                    ->numeric(),
                TextEntry::make('width')
                    ->numeric(),
                TextEntry::make('height')
                    ->numeric(),
                TextEntry::make('shipment_value')
                    ->label('Shipment Value')
                    ->money(),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('status'),
                TextEntry::make('payment_status'),
                TextEntry::make('driver.name')
                    ->label('Driver'),
                TextEntry::make('vehicle.number_plate')
                    ->label('Vehicle'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
