<?php

namespace App\Filament\Resources\PricingRules;

use App\Filament\Resources\PricingRules\Pages\CreatePricingRule;
use App\Filament\Resources\PricingRules\Pages\EditPricingRule;
use App\Filament\Resources\PricingRules\Pages\ListPricingRules;
use App\Filament\Resources\PricingRules\Pages\ViewPricingRule;
use App\Filament\Resources\PricingRules\Schemas\PricingRuleForm;
use App\Filament\Resources\PricingRules\Schemas\PricingRuleInfolist;
use App\Filament\Resources\PricingRules\Tables\PricingRulesTable;
use App\Models\PricingRule;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PricingRuleResource extends Resource
{
    protected static ?string $model = PricingRule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PricingRuleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PricingRuleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PricingRulesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPricingRules::route('/'),
            'create' => CreatePricingRule::route('/create'),
            'view' => ViewPricingRule::route('/{record}'),
            'edit' => EditPricingRule::route('/{record}/edit'),
        ];
    }
}
