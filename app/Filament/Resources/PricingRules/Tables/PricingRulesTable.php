<?php

namespace App\Filament\Resources\PricingRules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PricingRulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('tenant_id')
                    ->searchable(),
                TextColumn::make('category_id')
                    ->searchable(),
                TextColumn::make('origin_location_id')
                    ->searchable(),
                TextColumn::make('destination_location_id')
                    ->searchable(),
                TextColumn::make('base_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price_per_kg')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price_per_dimension')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('min_weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('min_length')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_length')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('min_width')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_width')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('min_height')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_height')
                    ->numeric()
                    ->sortable(),
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
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
