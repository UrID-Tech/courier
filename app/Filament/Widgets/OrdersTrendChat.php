<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersTrendChat extends ChartWidget
{
    protected ?string $heading = '📈 Orders Over Time';

    protected function getData(): array
    {
        // Example: orders grouped by month
        $orders = Order::query()
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $orders->values(),
                    'borderColor' => '#3b82f6', // blue-500
                    'backgroundColor' => 'rgba(59,130,246,0.2)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $orders->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // could also be 'bar'
    }
}
