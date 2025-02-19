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
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
            'price' => 'required|numeric',
            'status' => 'required|string|in:Scheduled,In Progress,Part/Return,Complete,Cancelled',
            'file_attachments.*' => 'nullable|file|mimes:pdf,jpg|max:2048',
            'notes' => 'nullable|string',
        ]);

        $workOrder = new WorkOrder();
        $workOrder->user_id = auth()->id();
        $workOrder->customer_id = $validatedData['customer_id'];
        $workOrder->title = $validatedData['title'];
        $workOrder->description = $validatedData['description'];
        $workOrder->date_time = $validatedData['date_time'];
        $workOrder->price = $validatedData['price'];
        $workOrder->status = $validatedData['status'];
        $workOrder->notes = $validatedData['notes'];

        if ($request->hasFile('file_attachments')) {
            $fileAttachments = [];
            foreach ($request->file('file_attachments') as $file) {
                $path = $file->store('work_orders', 'public');
                $fileAttachments[] = $path;
            }
            $workOrder->file_attachments = json_encode($fileAttachments);
        }

        $workOrder->save();

        $userName = auth()->user()->name;
        return redirect(route('dashboard', ['absolute' => true]))->with('message', "Work order created successfully by $userName");
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
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'price' => 'required|numeric',
            'status' => 'required|string|in:Scheduled,In Progress,Part Needed,Complete,Cancelled',
            'file_attachments.*' => 'nullable|file|mimes:pdf,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'scheduled_at' => 'required|date',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,heic|max:2048',
            'notes' => 'nullable|string',
        ]);

        $workOrder = WorkOrder::findOrFail($id);
        $workOrder->user_id = auth()->id();
        $workOrder->customer_name = $validatedData['customer_name'];
        $workOrder->title = $validatedData['title'];
        $workOrder->description = $validatedData['description'];
        $workOrder->date_time = $validatedData['date_time'];
        $workOrder->price = $validatedData['price'];
        $workOrder->status = $validatedData['status'];
        $workOrder->notes = $validatedData['notes'];

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('work_orders', 'public');
                $images[] = $path;
            }
            $workOrder->images = json_encode($images);
        }

        $workOrder->save();

        $userName = auth()->user()->name;
        return redirect()->route('dashboard')->with('message', "Work order updated successfully by $userName");
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $workOrder->delete();

        return redirect()->route('dashboard')->with('message', "Work order deleted successfully by $userName");
    }

    // Duplicate the specified resource
    public function duplicate($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $newWorkOrder = $workOrder->replicate();
        $newWorkOrder->user_id = auth()->id();
        $newWorkOrder->title = $workOrder->title . ' (Copy)';
        $newWorkOrder->save();

        return redirect()->route('dashboard')->with('message', "Work order duplicated successfully by $userName");
    }
}