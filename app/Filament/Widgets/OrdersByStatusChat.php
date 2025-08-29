<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersByStatusChart extends ChartWidget
{
    protected  ?string $heading = '📊 Orders by Status';

    protected function getData(): array
    {
        $statuses = Order::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $statuses->values(),
                    'backgroundColor' => [
                        '#3b82f6', // blue
                        '#10b981', // green
                        '#f59e0b', // yellow
                        '#ef4444', // red
                        '#8b5cf6', // purple
                        '#6b7280', // gray
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $statuses->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // could also be 'doughnut'
    }
}
