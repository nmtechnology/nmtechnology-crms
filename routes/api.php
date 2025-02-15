<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\GroqController;
use Inertia\Inertia;

Route::get('/users', function () {
    return new UserCollection(User::all());
});

Route::get('/current-time', function () {
    return response()->json([
        'current_time' => now()->format('Y-m-d H:i:s')
    ]);
});

// // Add the new endpoint for GroqQuery
// Route::get('/groq/query', [GroqController::class, 'query'])->name('groq.query');