<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\WorkOrderController;

Route::get('/current-time', [TimeController::class, 'getCurrentTime']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    sleep(2);
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/api/work-orders', [WorkOrderController::class, 'store']);
});

Route::get('/users', function () {
    return new UserCollection(User::all());
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('work-orders/store', [WorkOrderController::class, 'store']);
    Route::get('/work-orders', [WorkOrderController::class, 'index']);
    Route::get('/work-orders/{workOrder}', [WorkOrderController::class, 'show']);
    Route::patch('/work-orders/{workOrder}', [WorkOrderController::class, 'update']);
    Route::delete('/work-orders/{workOrder}', [WorkOrderController::class, 'destroy']);
});
  
Route::get('/current-time', [TimeController::class, 'getCurrentTime']);

require __DIR__.'/auth.php';
