<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkOrder;
use Inertia\Inertia;

class WorkOrderController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $workOrders = WorkOrder::all();
        return Inertia::render('WorkOrders/Index', [
            'workOrders' => $workOrders,
        ]);
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('work_orders.create');
    }

    // Store a newly created resource in storage
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

        return redirect()->route('dashboard')->with('message', 'Work order created successfully');
    }

    // Display the specified resource
    public function show($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        return view('work_orders.show', compact('workOrder'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        return view('work_orders.edit', compact('workOrder'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'scheduled_at' => 'required|date',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,heic|max:2048',
            'notes' => 'nullable|string',
        ]);

        $workOrder = WorkOrder::findOrFail($id);
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

        return redirect()->route('dashboard')->with('message', 'Work order updated successfully');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $workOrder->delete();

        return redirect()->route('dashboard')->with('message', 'Work order deleted successfully');
    }
    // Duplicate the specified resource
    public function duplicate($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $newWorkOrder = $workOrder->replicate();
        $newWorkOrder->title = $workOrder->title . ' (Copy)';
        $newWorkOrder->save();

        return redirect()->route('dashboard')->with('message', 'Work order duplicated successfully');
    }
}