<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\TrackingEvent;
use App\Observers\OrderObserver;
use App\Observers\TrackingEventObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Order::observe(OrderObserver::class);
        TrackingEvent::observe(TrackingEventObserver::class);
    }
}
