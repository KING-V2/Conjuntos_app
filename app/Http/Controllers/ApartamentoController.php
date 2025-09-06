<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApartamentoRequest;
use App\Http\Requests\UpdateApartamentoRequest;
use App\Models\Administracion\Apartamento;
use App\Models\Correspondencia\Correspondencia;
use App\Models\Administracion\Bloque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartamentos = Apartamento::all();
        $bloques = Bloque::all();
        return view('admin.apartamentos.add',
            [
                'apartamentos' => $apartamentos,
                'bloques' => $bloques,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartamentoRequest $request)
    {
        try {
            $apartamento = new Apartamento();
            $apartamento->nombre        = $request->input('nombre');
            $apartamento->codigo        = $request->input('codigo');
            $apartamento->estado        = $request->input('estado');
            $apartamento->bloque_id     = $request->input('bloque_id');
            
            if( $apartamento->save() ){
                $correspondencia = new Correspondencia();
                $correspondencia->apartamento_id = $apartamento->id;
                $correspondencia->bloque_id = $request->input('bloque_id');
                $correspondencia->save();
                
                log_evento('Registro Correspondencia', [
                    'id' => $correspondencia->id,
                    'apartamento_id' => $correspondencia->apartamento_id,
                    'bloque_id' => $correspondencia->bloque_id
                ]);
            }

            $json = json_encode( $request->all() );
            log_evento('Registro Apartamento', $json);

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('apartamentos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartamento $apartamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartamento $apartamento, $id)
    {
        try{
            $apartamento     = Apartamento::findOrFail( $id );
            $bloques   = Bloque::all();
            return view('admin.apartamentos.edit',
                [
                    'apartamento'    => $apartamento,
                    'bloques'  => $bloques,
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('apartamentos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartamentoRequest $request, Apartamento $apartamento)
    {
        try {
            $apartamento =   Apartamento::find( $request->input('apartamento_id') );
            $apartamento->nombre        = $request->input('nombre');
            $apartamento->codigo        = $request->input('codigo');
            $apartamento->estado        = $request->input('estado');
            $apartamento->bloque_id     = $request->input('bloque_id');
            $json = json_encode( $request->all() );
            log_evento('Update Apartamento', $json);

            $apartamento->save();
            session()->flash('flash_success_message', 'Actualizado');

        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('apartamentos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartamento $apartamento,$id)
    {
        if ($id > 0) {
            try {
                $apartamento = Apartamento::find( $id );
                $correspondencia = Correspondencia::where('apartamento_id',$id )->first();
                $correspondencia->delete();
                log_evento('Destroy Apartamento', ['id' => $id]);
                if( $apartamento->delete() ){
                    session()->flash('flash_success_message', 'eliminado correctamente');
                }
                else
                {
                    session()->flash('flash_error_message', 'Ocurrió un eliminando el registro');
                }
            } catch (\Throwable $th) {
                session()->flash('flash_error_message', $th->getMessage());
            }
        }else{
            session()->flash('flash_error_message', 'No existe la apartamento');
        }
        return redirect('apartamentos');
    }

    public function getApartamentosPorEstado($estado)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $apartamentos = Apartamento::where('estado',$estado)->get();
        return response()->json($apartamentos, 200, $header);
    }

    public function getApartamentos($bloque_id) {
        $apartamentos = Apartamento::where('bloque_id', $bloque_id)->get();
        return response()->json($apartamentos);
    }
}
