<?php

namespace App\Filament\Resources\TrackingEvents\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TrackingEventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('order.tracking_number'),
                TextEntry::make('location.name'),
                TextEntry::make('user.name'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
