<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller
{
    public function getCurrentTime()
    {
        $currentTime = DB::select('SELECT NOW() as current_time');
        return response()->json(['current_time' => $currentTime[0]->current_time]);
    }
}
