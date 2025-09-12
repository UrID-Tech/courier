<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatus;
use App\Filament\Exports\OrderExporter;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Services\ShippingLabelService;
use Filament\Actions\ExportAction;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Grid;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')
                //     ->label('ID'),
                TextColumn::make('customer.name')
                    ->searchable(),
                TextColumn::make('tracking_number')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('origin.name')
                    ->searchable(),
                TextColumn::make('destination.name')
                    ->searchable(),
                TextColumn::make('receiver_name'),
                TextColumn::make('receiver_email'),
                TextColumn::make('receiver_phone'),
                TextColumn::make('driver.name')
                    ->label('Driver'),
                TextColumn::make('vehicle.number_plate')
                    ->label('Vehicle'),
                TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('length')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('width')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('height')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('shipment_value'),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                SelectFilter::make('status')
                    ->options(OrderStatus::class)
                    ->label('Status'),
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                SelectFilter::make('origin_id')
                    ->relationship('origin', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Origin'),
                SelectFilter::make('destination_id')
                    ->relationship('destination', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Destination'),
                SelectFilter::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Customer'),
                SelectFilter::make('driver_id')
                    ->relationship('driver', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Driver'),
                SelectFilter::make('vehicle_id')
                    ->relationship('vehicle', 'number_plate')
                    ->searchable()
                    ->preload()
                    ->label('Vehicle'),
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_from')
                            ->label('Date From'),
                        DatePicker::make('created_until')
                            ->label('Date Until'),
                    ])->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('print_label')
                    ->label('Print Label')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn($record) => route('filament.admin.resources.orders.shipping-label', ['ids' => $record->id, 'record' => $record->id]))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('print_labels')
                        ->label('Print Labels')
                        ->icon('heroicon-o-printer')
                        ->accessSelectedRecords()
                        ->color('success')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $ids = $records->pluck('id')->toArray();
                            $filePath = ShippingLabelService::generateBulk($ids);
                            $fullUrl = Storage::url($filePath);

                            Notification::make()
                                ->title('Lables Generated')
                                ->success()
                                ->body('Now Available for download.')
                                ->actions([
                                    Action::make('Download')
                                        ->button()
                                        ->url($fullUrl, shouldOpenInNewTab: true),

                                ])
                                ->send();
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(OrderExporter::class)
            ]);
    }
}
