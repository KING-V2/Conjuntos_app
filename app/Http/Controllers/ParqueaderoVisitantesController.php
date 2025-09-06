<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParqueaderoVisitantesRequest;
use App\Http\Requests\UpdateParqueaderoVisitantesRequest;
use App\Models\Parqueaderos\ParqueaderoVisitantes;
use App\Models\Administracion\Parqueadero;
use App\Models\Parqueaderos\TarifasConjunto;
use App\Models\Parqueaderos\CategoriaVehiculo;
use App\Models\Administracion\Conjunto;
use Carbon\Carbon;

class ParqueaderoVisitantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parqueaderos = Parqueadero::where('estado', 'Visitantes')->get();
        $categoria = CategoriaVehiculo::all();
        $precio = CategoriaVehiculo::all();
        $parqueadero_visitantes = ParqueaderoVisitantes::all();

        $pq_ocupados = $parqueadero_visitantes->where('hora_salida', null)->count();
        $pq_disponibles = $parqueadero_visitantes->where('hora_salida', null)->count();

        $disponibilidad = [];

        foreach ($categoria as $cat) {
            $ocupados = $parqueadero_visitantes->where('categoria_id', $cat->id)->where('hora_salida',null)->count();
            $limite = (int) $cat->limite;
            $disponibles = max($limite - $ocupados, 0);

            $disponibilidad[] = [
                'nombre' => $cat->nombre,
                'disponibles' => $disponibles,
                'ocupados' => $ocupados,
                'limite' => $limite,
            ];
        }
        return view('admin.parqueadero_visitante.add',
            [
                'parqueaderos' => $parqueaderos,
                'categorias' => $categoria,
                'precios' => $precio,
                'parqueadero_visitantes' => $parqueadero_visitantes,
                'disponibilidad' => $disponibilidad
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
    public function store(StoreParqueaderoVisitantesRequest $request)
    {
        try {
            $parqueadero_v   = new ParqueaderoVisitantes();
            $parqueadero_v->placa           = $request->input('placa');
            $parqueadero_v->parqueadero_id  = $request->input('parqueadero_id');
            $parqueadero_v->categoria_id    = $request->input('categoria_id');
            $parqueadero_v->precio_id       = $request->input('precio_id');
            
            //se cambia el estado del parqueadero a ocupado
            $parqueadero = Parqueadero::find( $parqueadero_v->parqueadero->id )->first();
            $parqueadero->estado = 'Ocupado';
            $parqueadero->save();
            
            $parqueadero_v->hora_ingreso      = now();
            $parqueadero_v->valor      = 0;
            $parqueadero_v->save();


            session()->flash('flash_success_message', 'registro exitoso');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('parqueadero_visitante');
    }

    /**
     * Display the specified resource.
     */
    public function show(ParqueaderoVisitantes $parqueaderoVisitantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParqueaderoVisitantes $parqueaderoVisitantes,$id)
    {
        $parqueaderos = Parqueadero::where('estado', 'Visitantes')->get();
        $parqueadero_visitantes = ParqueaderoVisitantes::find($id);
        $categorias = CategoriaVehiculo::all();
        $precios = CategoriaVehiculo::all();
        return view('admin.parqueadero_visitante.edit',
            [
                'parqueaderos' => $parqueaderos,
                'categorias' => $categorias,
                'precios' => $precios,
                'parqueadero_visitantes' => $parqueadero_visitantes,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParqueaderoVisitantesRequest $request)
    {
        try {
            $parqueadero   = ParqueaderoVisitantes::find($request->input('parqueadero_visitante_id'));
            $parqueadero->placa             = $request->input('placa');
            $parqueadero->parqueadero_id    = $request->input('parqueadero_id');
            $parqueadero->categoria_id    = $request->input('categoria_id');
            $parqueadero->precio_id       = $request->input('precio_id');
            $parqueadero->hora_ingreso      = $parqueadero->hora_ingreso;
            $parqueadero->valor             = 0;
            $parqueadero->save();
            session()->flash('flash_success_message', 'registro exitoso');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('parqueadero_visitante');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParqueaderoVisitantes $parqueaderoVisitantes)
    {
        //
    }

    public function registroSalidaVehiculo($id)
    {
        $header = ['Content-Type' => 'application/json', 'charset' => 'utf-8'];
        
        try {
            
            // Buscar el registro del visitante
            $parqueadero_v = ParqueaderoVisitantes::find($id);
            
            if (!$parqueadero_v) {
                return response()->json('Registro no encontrado', 404, $header);
            }
            
            // Calcular el tiempo transcurrido en minutos
            $hora_ingreso = Carbon::parse($parqueadero_v->hora_ingreso);
            $hora_salida = now();
            $minutos_transcurridos = $hora_ingreso->diffInMinutes($hora_salida);
            // Calcular el valor total
            $valor_total = $minutos_transcurridos * $parqueadero_v->categoria->valor;
            
            // Actualizar el registro
            $parqueadero_v->hora_salida = $hora_salida;
            $parqueadero_v->valor = $valor_total;
            $parqueadero_v->save();

            //se cambia el estado del parqueadero a ocupado
            $parqueadero_obj = Parqueadero::find( $parqueadero_v->parqueadero->id )->first();
            $parqueadero_obj->estado = 'Visitantes';
            $parqueadero_obj->save();
            
            // Redirigir a la vista del recibo
            return redirect()->route('recibo_parqueadero', ['id' => $parqueadero_v->id]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500, $header);
        }
    }


    public function factura($id)
    {
        $conjunto = Conjunto::first();
        $parqueadero = ParqueaderoVisitantes::find($id);
        return view('admin.formatos.factura',
            [
                'parqueadero' => $parqueadero,
                'conjunto' => $conjunto
            ]
        );
    }
}
