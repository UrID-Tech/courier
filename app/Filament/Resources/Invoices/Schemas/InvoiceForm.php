<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tenant_id')
                    ->required(),
                TextInput::make('order_id')
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
