<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ShippingLabelController;


Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::post('/quote/calculate', [QuoteController::class, 'calculate'])->name('quote.calculate');
Route::get('/tracking/track', [TrackingController::class, 'showForm'])->name('track.form');
Route::post('/tracking/track', [TrackingController::class, 'track'])->name('track.search');
Route::any('/label/print/{orderId}', [ShippingLabelController::class, 'generate'])->name('shipping.label.pdf');
Route::any('/label/print/bulk/{ids}', [ShippingLabelController::class, 'bulkLabel'])->name('shipping.label.bulk-pdf');
Route::get('/tracking/{tracking_number}', [TrackingController::class, 'trackByNumber'])->name('track.order');
