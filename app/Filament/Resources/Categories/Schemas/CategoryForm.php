<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Enums\PricingStrategy;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('pricing_strategy')
                    ->selectablePlaceholder(false)
                    ->options(PricingStrategy::class)
                    ->default(PricingStrategy::default())
                    ->enum(PricingStrategy::class),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
