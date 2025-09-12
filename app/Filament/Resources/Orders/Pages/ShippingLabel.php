<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use App\Models\Order;

class ShippingLabel extends Page
{
    use InteractsWithRecord;

    protected static string $resource = OrderResource::class;

    protected string $view = 'filament.resources.orders.pages.shipping-label';
    public $order;

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->order = $this->record;
    }
}
