<?php

namespace App\Filament\Widgets;

use App\Enums\PaymentStatus;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Customer;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();
        $totalRevenue = Order::where('payment_status', PaymentStatus::Paid)->sum('price');

        return [
            Stat::make('📦 Total Orders', $totalOrders)
                ->description('All customer orders')
                ->descriptionIcon('heroicon-o-truck')
                ->color('primary'),

            Stat::make('👤 Total Customers', $totalCustomers)
                ->description('Registered customers')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),

            Stat::make('💰 Total Revenue', number_format($totalRevenue, 2) . ' RWF')
                ->description('Sum of all orders')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('warning'),
        ];
    }
}
