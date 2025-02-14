<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class CurrentTimeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'current_time' => now()->format('Y-m-d H:i:s')
        ]);
    }
}
