<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Models\Reservas\Reserva;
use App\Models\Reservas\ZonaComun;
use App\Models\User;
use Illuminate\Http\Request;
 
class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::all();
        $usuarios = User::all();
        $zonas_comunes = ZonaComun::where('estado','Activo')->get();
        return view('admin.reservas.add',
            [
                'reservas' => $reservas,
                'usuarios' => $usuarios,
                'zonas' => $zonas_comunes
            ]
        );
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
    public function store(StoreReservaRequest $request)
    {
        try {
            $reserva = new Reserva();
            $reserva->fecha         = $request->input('fecha');
            $reserva->hora_inicio   = $request->input('hora_inicio');
            $reserva->hora_fin      = $request->input('hora_fin');
            $reserva->estado        = $request->input('estado');
            $reserva->usuario_id    = $request->input('usuario_id');
            $reserva->zona_comun_id = $request->input('zona_comun_id');
            $reserva->descripcion   = $request->input('descripcion');
            $reserva->save();
            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('reservas');
    }

    public function solicitar_reserva(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'estado' => 'required|string',
            'usuario_id' => 'required|integer',
            'zona_comun_id' => 'required|integer',
            'descripcion' => 'required|string|max:500',
        ]);

        try {
            $reserva = Reserva::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada exitosamente',
                'data' => $reserva
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la reserva: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function mis_reservas($id)
    {
        $usuarioId = $id;

        if (!$usuarioId) {
            return response()->json([
                'message' => 'El usuario es obligatorio.'
            ], 400);
        }

        $reservas = Reserva::with('zona_comun')
            ->where('usuario_id', $usuarioId)
            ->orderBy('fecha', 'desc')
            ->get()
            ->map(function ($reserva) {
                return [
                    'fecha' => $reserva->fecha,
                    'hora_inicio' => $reserva->hora_inicio,
                    'hora_fin' => $reserva->hora_fin,
                    'estado' => $reserva->estado,
                    'zona_comun_nombre' => $reserva->zona_comun->nombre ?? null,
                ];
            });

        return response()->json($reservas);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva,$id)
    {
        $reservas = Reserva::find($id);
        $usuarios = User::all();
        $zonas_comunes = ZonaComun::all();
        return view('admin.reservas.edit',
            [
                'reserva' => $reservas,
                'usuarios' => $usuarios,
                'zonas' => $zonas_comunes
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservaRequest $request, Reserva $reserva)
    {
        try {
            $reserva = Reserva::find( $request->input('reserva_id') );
            $reserva->fecha         = $request->input('fecha');
            $reserva->hora_inicio   = $request->input('hora_inicio');
            $reserva->hora_fin      = $request->input('hora_fin');
            $reserva->estado        = $request->input('estado');
            $reserva->usuario_id    = $request->input('usuario_id');
            $reserva->zona_comun_id = $request->input('zona_comun_id');
            $reserva->descripcion   = $request->input('descripcion');
            if( $request->input('descripcion_respuesta') ){
                $reserva->descripcion_respuesta   = $request->input('descripcion_respuesta');
            }
            if( $request->input('administrador_id') ){
                $reserva->administrador_id   = $request->input('administrador_id');
            }
            $reserva->save();
            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('reservas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
