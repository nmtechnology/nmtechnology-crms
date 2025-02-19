<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\GrokController;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GroqController;
use App\Http\Controllers\UserController;


Route::get('/customers', [CustomerController::class, 'index']);

Route::post('/grok/solutions', [GrokController::class, 'solutions']);
Route::post('/grok/solutions', [GroqController::class, 'solutions'])->name('grok.solutions');

Route::resource('customers', CustomerController::class)->middleware('auth:sanctum');

Route::get('/users', function () {
    return new UserCollection(User::all());
});

Route::get('/current-time', function () {
    return response()->json([
        'current_time' => now()->format('Y-m-d H:i:s')
    ]);
});

// Add the new endpoint for GroqQuery
Route::post('groq/query', [GroqController::class, 'query'])->name('groq.query');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Add this route to fetch the list of customers\
Route::resource('customers', CustomerController::class);

// Add this route to create a new work order
Route::post('/work-orders', [WorkOrderController::class, 'store']);
