<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkOrder;

class WorkOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'scheduled_at' => 'required|date',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,heic|max:2048',
            'notes' => 'nullable|string',
        ]);

        $workOrder = new WorkOrder();
        $workOrder->title = $request->title;
        $workOrder->description = $request->description;
        $workOrder->scheduled_at = $request->scheduled_at;
        $workOrder->status = 'scheduled';
        $workOrder->user_id = auth()->id();
        $workOrder->notes = $request->notes;

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('work_orders', 'public');
                $images[] = $path;
            }
            $workOrder->images = json_encode($images);
        }

        $workOrder->save();

        return response()->json(['message' => 'Work order created successfully']);

        dd('store work order');
    }
}