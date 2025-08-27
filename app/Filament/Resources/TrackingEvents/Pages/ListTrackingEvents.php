<?php

namespace App\Filament\Resources\TrackingEvents\Pages;

use App\Filament\Resources\TrackingEvents\TrackingEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrackingEvents extends ListRecords
{
    protected static string $resource = TrackingEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
