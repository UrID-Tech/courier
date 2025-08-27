<?php

namespace App\Filament\Resources\TrackingEvents\Pages;

use App\Filament\Resources\TrackingEvents\TrackingEventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTrackingEvent extends CreateRecord
{
    protected static string $resource = TrackingEventResource::class;
}
