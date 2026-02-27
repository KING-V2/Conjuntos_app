<?php

namespace App\Http\Controllers;

use App\Models\Facturacion;
use App\Models\Administracion\Conjunto;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Datetime;

class FacturacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function imprimir_factura($id)
    {
        $factura = Facturacion::with('ticket.apartamento', 'ticket.casa')->find($id);
        $conjunto = Conjunto::first();
        $fecha_hora = Carbon::now();
        $pdf = PDF::loadView('admin.facturacion.factura_pdf', compact('factura', 'conjunto', 'fecha_hora'));

        // Configuración para impresora térmica (80mm de ancho, alto automático)
        $pdf->setOptions([
            'dpi' => 120,
            'defaultPaperSize' => [0, 0, 226.77, 0], // 80mm = 226.77 puntos
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial Narrow'
        ]);

        $pdf->setPaper([0, 0, 226.77, 400]); // 80mm de ancho, alto infinito

        return $pdf->stream("factura.pdf");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Facturacion $facturacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facturacion $facturacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facturacion $facturacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facturacion $facturacion)
    {
        //
    }
}
