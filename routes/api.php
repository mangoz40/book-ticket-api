<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\BookingController;

Route::get('/events', [EventController::class, 'index']); // List all events
Route::get('/events/{event}', [EventController::class, 'show']); // Get a specific event (if needed)