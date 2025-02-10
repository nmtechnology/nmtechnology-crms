<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\TimeController;


// Route::get('/users', function () {
//     return new UserCollection(User::all());
// });

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('work-orders/store', [WorkOrderController::class, 'store']);
//     Route::get('/work-orders', [WorkOrderController::class, 'index']);
//     Route::get('/work-orders/{workOrder}', [WorkOrderController::class, 'show']);
//     Route::patch('/work-orders/{workOrder}', [WorkOrderController::class, 'update']);
//     Route::delete('/work-orders/{workOrder}', [WorkOrderController::class, 'destroy']);
// });
  
// Route::get('/current-time', [TimeController::class, 'getCurrentTime']);