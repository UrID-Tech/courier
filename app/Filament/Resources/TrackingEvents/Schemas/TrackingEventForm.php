<?php

namespace App\Filament\Resources\TrackingEvents\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TrackingEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order')
                    ->relationship('order', 'tracking_number')
                    ->required(),
                Select::make('location')
                    ->relationship()
                    ->default(null),
                // TextInput::make('user_id')
                //     ->default(null),
                TextInput::make('status')
                    ->required(),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
