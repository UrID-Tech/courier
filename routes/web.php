<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\WelcomeController;


Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::post('/quote/calculate', [QuoteController::class, 'calculate'])->name('quote.calculate');
Route::get('/tracking/track', [TrackingController::class, 'showForm'])->name('track.form');
Route::post('/tracking/track', [TrackingController::class, 'track'])->name('track.search');
