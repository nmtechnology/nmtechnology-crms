<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\WorkOrder;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'workOrders' => WorkOrder::orderBy('created_at', 'desc')->get()
        ]);
    }
}