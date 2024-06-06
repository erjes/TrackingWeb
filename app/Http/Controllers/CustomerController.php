<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function search(Request $request)
    {
        $customer = Customer::where('name', 'LIKE', '%' . $request->name . '%')->get();

        return response()->json($customer);
    }
   public function index()
    {
        $customer = Customer::all();

        return view('admin.customer')->with(compact('customer'));
    }

    public function create()
    {
        return view('admin.create.customer');
    }

    public function store(Request $request)
    {
        Customer::create($request->all());

        return redirect()->route('customer.index')->with('status', 'Customer Created.');
    }

    public function edit(string $id)
    {
        $customer = Customer::where('id',$id)->first();

        return view('admin.update.customer', compact('customer'));
    }

    public function update(Request $request, string $id)
    {
        $shipment = Customer::findOrFail($id);

        $shipment->update($request->all());

        return redirect()->route('customer.index')->with('status', 'Customer Updated.');
    }

    public function destroy(string $id)
    {
        $shipment = Customer::findOrFail($id);

        $shipment->delete();

    return redirect()->route('customer.index')->with('success', 'Shipment deleted successfully');
    }
}
