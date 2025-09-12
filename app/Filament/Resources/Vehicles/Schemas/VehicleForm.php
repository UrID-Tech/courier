<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use App\Enums\VehicleCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->selectablePlaceholder(false)
                    ->options(VehicleCategory::class)
                    ->enum(VehicleCategory::class)
                    ->default(VehicleCategory::default()),
                TextInput::make('number_plate')
                    ->required(),
            ]);
    }
}
