<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use Illuminate\Http\Request;

class CashController extends Controller
{
    public function index($session){
        $results = Cash::where('session', $session)
               ->where('type', 'history')
               ->get();

        return view('admin.cash')->with(compact('results'));
    }

    public function storeSession(Request $request){

        Cash::create([
            'session' => $request->session,
            'current' => $request->current,
            'type' => 'current',
        ]);

        return view('admin.cash')->with('status', 'Cash History Created.');
    }

    public function store(Request $request){

        Cash::create([
            'session' => $request->session,
            'current' => $request->current,
            'spend' => $request->spend,
            'type' => 'history',
        ]);

        return view('admin.cash')->with('status', 'Cash History Created.');
    }

    public function edit($id, Request $request){
        $session = Cash::findOrFail('id', $id);
        $session->update([
           'spend' => $request->spend,
           'purpose' => $request->purpose,
        ]);

        return redirect()->route('admin.cash')->with('success', 'Cash History Updated successfully');
    }

    public function destroy(string $id)
    {
        $shipment = Cash::findOrFail($id);

        $shipment->delete();

        return redirect()->route('admin.cash')->with('success', 'Cash History deleted successfully');
    }
}
