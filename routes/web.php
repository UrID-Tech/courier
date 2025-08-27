<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TrackingController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/quote/calculate', [QuoteController::class, 'calculate']);
Route::post('/tracking/track', [TrackingController::class, 'track']);
