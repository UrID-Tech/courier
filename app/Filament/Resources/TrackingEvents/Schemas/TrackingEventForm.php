<?php

namespace App\Filament\Resources\TrackingEvents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TrackingEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tenant_id')
                    ->required(),
                TextInput::make('order_id')
                    ->required(),
                TextInput::make('location_id')
                    ->default(null),
                TextInput::make('user_id')
                    ->default(null),
                TextInput::make('status')
                    ->required(),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
