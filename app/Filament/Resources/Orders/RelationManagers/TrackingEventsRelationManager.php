<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Enums\DeliveryStatus;
use App\Enums\OrderStatus;
use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables;

class TrackingEventsRelationManager extends RelationManager
{
    protected static string $relationship = 'trackingEvents';

    protected static ?string $recordTitleAttribute = 'order_id';

    //protected static ?string $relatedResource = OrderResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('location.name'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->inverseRelationship('order');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('location_id')
                    ->relationship('location', 'name')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Shipment Status')
                    ->selectablePlaceholder(false)
                    ->options(DeliveryStatus::class)
                    ->default(DeliveryStatus::default())
                    ->enum(DeliveryStatus::class)
                    ->live(),
                Forms\Components\Textarea::make('remarks'),
                Forms\Components\TextInput::make('delivered_by')
                    ->label('Delivered By')
                    ->visible(fn(Get $get): bool => $get('status') === DeliveryStatus::Delivered),
                Forms\Components\DateTimePicker::make('delivered_at')
                    ->label('Delivery Time')
                    ->visible(fn(Get $get): bool => $get('status') === DeliveryStatus::Delivered),
                Forms\Components\TextInput::make('received_by')
                    ->label('Received By')
                    ->visible(fn(Get $get): bool => $get('status') === DeliveryStatus::Delivered),
                Forms\Components\TextInput::make('received_by_phone_number')
                    ->label('Recipient Phone Number')
                    ->visible(fn(Get $get): bool => $get('status') === DeliveryStatus::Delivered),
            ]);
    }
}
