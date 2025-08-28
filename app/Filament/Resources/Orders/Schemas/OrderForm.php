<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer')
                    ->relationship('customer', 'name')
                    ->required(),
                Select::make('category')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('origin')
                    ->relationship('origin', 'name')
                    ->required(),
                Select::make('destination')
                    ->relationship('destination', 'name')
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
}
