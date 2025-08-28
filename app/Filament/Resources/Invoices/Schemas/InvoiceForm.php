<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order')
                    ->relationship('order', 'id')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('payment_method')
                    ->default(null),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('receipt_url')
                    ->default(null),
            ]);
    }
}
