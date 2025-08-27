<?php

namespace App\Filament\Resources\TrackingEvents;

use App\Filament\Resources\TrackingEvents\Pages\CreateTrackingEvent;
use App\Filament\Resources\TrackingEvents\Pages\EditTrackingEvent;
use App\Filament\Resources\TrackingEvents\Pages\ListTrackingEvents;
use App\Filament\Resources\TrackingEvents\Pages\ViewTrackingEvent;
use App\Filament\Resources\TrackingEvents\Schemas\TrackingEventForm;
use App\Filament\Resources\TrackingEvents\Schemas\TrackingEventInfolist;
use App\Filament\Resources\TrackingEvents\Tables\TrackingEventsTable;
use App\Models\TrackingEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TrackingEventResource extends Resource
{
    protected static ?string $model = TrackingEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TrackingEventForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TrackingEventInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrackingEventsTable::configure($table);
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
            'index' => ListTrackingEvents::route('/'),
            'create' => CreateTrackingEvent::route('/create'),
            'view' => ViewTrackingEvent::route('/{record}'),
            'edit' => EditTrackingEvent::route('/{record}/edit'),
        ];
    }
}
