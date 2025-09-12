<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('customer.name')
                ->label('Customer Name'),
            ExportColumn::make('tracking_number'),
            ExportColumn::make('category.name')
                ->label('Category'),
            ExportColumn::make('driver.name')
                ->label('Driver'),
            ExportColumn::make('vehicle.number_plate')
                ->label('Vehicle'),
            ExportColumn::make('shipment_value'),
            ExportColumn::make('origin.name')
                ->label('Origin Location'),
            ExportColumn::make('destination.name')
                ->label('Destination Location'),
            ExportColumn::make('weight'),
            ExportColumn::make('length'),
            ExportColumn::make('width'),
            ExportColumn::make('height'),
            ExportColumn::make('price'),
            ExportColumn::make('status'),
            ExportColumn::make('receiver_name'),
            ExportColumn::make('receiver_email'),
            ExportColumn::make('receiver_phone'),
            ExportColumn::make('receiver_address'),
            ExportColumn::make('notes'),
            ExportColumn::make('requires_delivery_confirmation'),
            ExportColumn::make('payment_status'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
