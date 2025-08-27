<?php

namespace App\Filament\Resources\TrackingEvents\Pages;

use App\Filament\Resources\TrackingEvents\TrackingEventResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTrackingEvent extends EditRecord
{
    protected static string $resource = TrackingEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
