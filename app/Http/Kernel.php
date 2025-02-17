<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\GroqController;
use App\Http\Controllers\CustomerController;
use App\Models\User;
use App\Http\Resources\UserCollection;

class Kernel extends \Illuminate\Foundation\Http\Kernel {
    protected $middlewareGroups = [
        'web' => [
            // ... existing middleware ...
            \App\Http\Middleware\HandleInertiaRequests::class,
        ],
    ];
}