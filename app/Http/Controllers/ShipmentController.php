<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{

    public function search(Request $request)
    {
        $query = DB::table('Shipment')
            ->join('Customer as sender', 'Shipment.sender_id', '=', 'sender.id')
            ->join('Customer as recipient', 'Shipment.recipient_id', '=', 'recipient.id')
            ->select('Shipment.*', 'sender.name as sender_name', 'recipient.name as recipient_name')
            ->orderBy('Shipment.created_at', 'desc')
            ->limit(100);

        if ($request->has('status') && $request->status != null) {
            $query->where('Shipment.status', $request->status);
        }

        if ($request->has('shipment_number') && !empty($request->shipment_number)) {
            $query->where('Shipment.shipment_number', 'LIKE', '%' . $request->shipment_number . '%');
        }

        $shipments = $query->get();

        return response()->json($shipments);
    }

    public function index()
    {
        $shipments = DB::table('Shipment')
        ->join('Customer as sender', 'Shipment.sender_id', '=', 'sender.id')
        ->join('Customer as recipient', 'Shipment.recipient_id', '=', 'recipient.id')
        ->select('Shipment.*', 'sender.name as sender_name', 'recipient.name as recipient_name')
        ->orderBy('Shipment.created_at', 'desc') // Order by created_at descending
        ->limit(100) // Limit to 100 records
        ->get();

        return view('admin.dashboard')->with(compact('shipments'));
    }

    public function create()
    {
        $customers = Customer::all();

        return view('admin.create.shipment')->with(compact('customers'));
    }

    public function store(Request $request)
    {
        // $lastShipmentNumber = Shipment::orderBy('shipment_number', 'desc')->first(); // Get last shipment number
        // $currentNumber = (int)substr($lastShipmentNumber->shipment_number, 2); // Extract numeric part

        // $newNumber = $currentNumber + 1;
        // $formattedNumber = 'RC' . str_pad($newNumber, 5, '0', STR_PAD_LEFT)
        $totalCost = $request->shipping_cost + $request->other_costs;

        if($request->recipient_id != null || $request->sender_id != null){
            Shipment::create([
                'shipment_number' => $request->shipment_number,
                'date' => $request->date,
                'item_type' => $request->item_type,
                'quantity' => $request->quantity,
                'weight' => $request->weight,
                'cubic_meters' => $request->cubic_meters,
                'sender_id' => $request->sender_id,
                'recipient_id' => $request->recipient_id,
                'origin_location' => $request->origin_location,
                'destination_location' => $request->destination_location,
                'shipping_cost' => $request->shipping_cost,
                'other_costs' => $request->other_costs,
                'total_cost' => $totalCost,
                'status' => 'PENDING'
            ]);
        }else{
            $sender = Customer::create([
                'name' => $request->new_sender_name,
                'phone' => $request->new_sender_phone,
                'address' => $request->new_sender_address,
            ]);

            $recepient = Customer::create([
                'name' => $request->new_recipient_name,
                'phone' => $request->new_recipient_phone,
                'address' => $request->new_recipient_address,
            ]);
            if($recepient->id != null || $sender->id != null){
                Shipment::create([
                    'shipment_number' => $request->shipment_number,
                    'date' => $request->date,
                    'item_type' => $request->item_type,
                    'quantity' => $request->quantity,
                    'weight' => $request->weight,
                    'cubic_meters' => $request->cubic_meters,
                    'sender_id' => $sender->id,
                    'recipient_id' => $recepient->id,
                    'origin_location' => $request->origin_location,
                    'destination_location' => $request->destination_location,
                    'shipping_cost' => $request->shipping_cost,
                    'other_costs' => $request->other_costs,
                    'total_cost' => $totalCost,
                    'status' => 'PENDING'
                ]);
            }
        }
        return redirect()->route('admin.dashboard')->with('status', 'Shipment Created.');
    }
    public function track()
    {
        return view('i-shipment');
    }
    public function show(Request $request)
    {
        $query = DB::table('Shipment')
        ->join('Customer as sender', 'Shipment.sender_id', '=', 'sender.id')
        ->join('Customer as recipient', 'Shipment.recipient_id', '=', 'recipient.id')
        ->select('Shipment.*', 'sender.name as sender_name', 'recipient.name as recipient_name')
        ->orderBy('Shipment.created_at', 'desc')
        ->limit(100);

        if ($request->has('shipment_number')) {
        $query->where('Shipment.shipment_number', $request->shipment_number);

        $shipment = $query->first();

        if ($shipment) {
            $events = ShipmentEvent::where('shipment_number', $request->shipment_number)->get();
            return view('track', compact('events', 'shipment'));
        } else {
            // Shipment not found
            return back()->with('status', 'Shipment not found.');
        }
        } else {
            return back()->with('status', 'Please provide a shipment number.');
        }

    }

    public function edit(string $id)
    {
        $query = DB::table('Shipment')
        ->join('Customer as sender', 'Shipment.sender_id', '=', 'sender.id')
        ->join('Customer as recipient', 'Shipment.recipient_id', '=', 'recipient.id')
        ->select('Shipment.*', 'sender.name as sender_name', 'recipient.name as recipient_name')
        ->orderBy('Shipment.created_at', 'desc')
        ->limit(100);

        $query->where('Shipment.shipment_number', $id);

        $shipment = $query->first();

        return view('admin.update.shipment', compact('shipment'));
    }

    public function update(Request $request, string $id)
    {
        $shipment = Shipment::findOrFail($id);
        $totalCost = $request->shipping_cost + $request->other_costs;
        $shipment->update([
            'shipment_number' => $request->shipment_number,
            'date' => $request->date,
            'item_type' => $request->item_type,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
            'cubic_meters' => $request->cubic_meters,
            'origin_location' => $request->origin_location,
            'destination_location' => $request->destination_location,
            'shipping_cost' => $request->shipping_cost,
            'other_costs' => $request->other_costs,
            'total_cost' => $totalCost,
            'status' => 'PENDING'
        ]);

        return redirect()->back()->with('status', 'Shipment Updated.');
    }

    public function destroy(string $id)
    {
        $shipment = Shipment::findOrFail($id);

        $shipment->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Shipment deleted successfully');
    }
}
