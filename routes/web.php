<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\WorkOrderController;

Route::get('/current-time', [TimeController::class, 'getCurrentTime']);

Route::get('/', function () {
    return Inertia('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    sleep(2);
    return Inertia('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/work-orders', function () {
    return Inertia('WorkOrder/Index');
})->middleware(['auth', 'verified'])->name('work-order.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/api/work-orders', [WorkOrderController::class, 'store']);
});

Route::get('/users', function () {
    return new UserCollection(User::all());
});

Route::resource('work-orders', WorkOrderController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/work-orders', [WorkOrderController::class, 'index'])->name('work-orders.index');
    Route::get('/work-orders/create', [WorkOrderController::class, 'create'])->name('work-orders.create');
    Route::post('/work-orders', [WorkOrderController::class, 'store'])->name('work-orders.store');
    Route::get('/work-orders/{workOrder}', [WorkOrderController::class, 'show'])->name('work-orders.show');
    Route::get('/work-orders/{workOrder}/edit', [WorkOrderController::class, 'edit'])->name('work-orders.edit');
    Route::patch('/work-orders/{workOrder}', [WorkOrderController::class, 'update'])->name('work-orders.update');
    Route::delete('/work-orders/{workOrder}', [WorkOrderController::class, 'destroy'])->name('work-orders.destroy');
    Route::post('/work-orders/{workOrder}/duplicate', [WorkOrderController::class, 'duplicate'])->name('work-orders.duplicate');
});

require __DIR__.'/auth.php';
