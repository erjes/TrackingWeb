<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentEventController extends Controller
{

    public function index(string $id)
    {
        $query = DB::table('Shipment')
        ->join('Customer as sender', 'Shipment.sender_id', '=', 'sender.id')
        ->join('Customer as recipient', 'Shipment.recipient_id', '=', 'recipient.id')
        ->select('Shipment.*', 'sender.name as sender_name', 'recipient.name as recipient_name')
        ->orderBy('Shipment.created_at', 'desc')
        ->limit(100);

        $query->where('Shipment.shipment_number', $id);

        $shipment = $query->first();

        $events = ShipmentEvent::where('shipment_number',$id)->get();

        return view('admin.shipment_event', compact('events','shipment'));
    }

    public function create($id)
    {
        $query = DB::table('Shipment')
        ->join('Customer as sender', 'Shipment.sender_id', '=', 'sender.id')
        ->join('Customer as recipient', 'Shipment.recipient_id', '=', 'recipient.id')
        ->select('Shipment.*', 'sender.name as sender_name', 'recipient.name as recipient_name')
        ->orderBy('Shipment.created_at', 'desc')
        ->limit(100);

        $query->where('Shipment.shipment_number', $id);

        $shipment = $query->first();

        $events = ShipmentEvent::where('shipment_number',$id)->get();

        return view('admin.create.shipment_event', compact('events','shipment'));
    }

    public function store(Request $request, $id)
    {
        ShipmentEvent::create($request->all());

        return redirect()->route('shipment-event.index',$id)->with('status', 'Shipment Event Created.');
    }

    public function edit(string $id)
    {
        $Shipment = ShipmentEvent::where('shipment_number',$id)->get();

        return view('update.shipment', compact('Shipment'));
    }

    public function update(Request $request, string $id)
    {
        $shipment = ShipmentEvent::findOrFail($id);

        $shipment->update($request->all());

        return redirect()->route('admin.dashboard')->with('status', 'Shipment Event Updated.');
    }

    public function destroy(string $id)
    {
        $shipment = ShipmentEvent::findOrFail($id);

        $shipment->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Shipment Event deleted successfully');
    }
}
