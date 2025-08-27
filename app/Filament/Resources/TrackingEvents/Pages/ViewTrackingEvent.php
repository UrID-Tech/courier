<?php

namespace App\Filament\Resources\TrackingEvents\Pages;

use App\Filament\Resources\TrackingEvents\TrackingEventResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTrackingEvent extends ViewRecord
{
    protected static string $resource = TrackingEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
