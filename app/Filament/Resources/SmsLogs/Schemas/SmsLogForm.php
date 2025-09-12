<?php

namespace App\Filament\Resources\SmsLogs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SmsLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tenant_id')
                    ->required(),
                TextInput::make('recipient')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('gateway')
                    ->required(),
                TextInput::make('reference')
                    ->default(null),
                TextInput::make('gateway_result')
                    ->default(null),
                TextInput::make('order_id')
                    ->default(null),
            ]);
    }
}
