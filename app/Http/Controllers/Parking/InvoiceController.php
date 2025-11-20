<?php

namespace App\Http\Controllers\Parking;

use Illuminate\Http\Request;
use App\Models\Parking\Invoice;
use App\Models\Parking\Client;
use App\Models\Parking\Vehicle;

class InvoiceController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $vehicles = Vehicle::all();
        return view('admin.parking.invoices', compact('clients', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|unique:invoices',
            'client_id' => 'required|exists:clients,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'amount' => 'required|string',
            'invoice_date' => 'required|date',
        ]);

        Invoice::create($request->all());

        return redirect()->back()->with('success', 'Factura creada correctamente');
    }
}
