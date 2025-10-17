<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasificadosRequest;
use App\Http\Requests\UpdateClasificadosRequest;
use App\Models\Emprendimientos\Clasificados;
use App\Models\Emprendimientos\ClasificadoGaleria;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Apartamento;
use Illuminate\Support\Facades\Storage;



class ClasificadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $clasificados = Clasificados::all();
            $casas = Casas::all();
            return view('admin.clasificados.add',
                [
                    'clasificados' => $clasificados,
                    'casas' => $casas,
                ]
            );
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return back()->withInput();
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
    public function store(StoreClasificadosRequest $request)
    {
        try {
            $clasificados = new Clasificados();
            $clasificados->casa             = $request->input('casa');
            $clasificados->descripcion      = $request->input('descripcion');
            $clasificados->estado           = $request->input('estado');
            $clasificados->whatsapp        = $request->input('whatsapp');
            $fecha                          = date('Ymdhis');
            $clasificados->foto             = 'foto_'.$fecha.'.'.$request->file('foto')->getClientOriginalExtension();
            Storage::disk('storage_clasificados')->put('foto_'.$fecha.'.'.$request->file('foto')->getClientOriginalExtension() , file_get_contents($request->file('foto')) );
        
            $clasificados->save();
            $json = json_encode( $request->all() );
            log_evento('Clasificado Store', $json);    

            session()->flash('flash_success_message', 'registro correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('clasificados');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clasificados $clasificados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clasificados $clasificados,$id)
    {
        try{
            $clasificado = Clasificados::findOrFail( $id );
            $casas = Casas::all();
            return view('admin.clasificados.edit',
                [
                    'clasificado' => $clasificado,
                    'casas' => $casas
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('clasificados');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasificadosRequest $request, Clasificados $clasificados)
    {
        try {
            $clasificados = Clasificados::findOrFail( $request->input('clasificado_id') );
            $clasificados->casa             = $request->input('casa');
            $clasificados->descripcion      = $request->input('descripcion');      
            $clasificados->estado           = $request->input('estado');
            $clasificados->whatsapp        = $request->input('whatsapp');
            
            if( !empty( $request->file('foto') ) ){
                $fecha              = date('Ymdhis');
                $clasificados->foto             = 'foto_'.$fecha.'.'.$request->file('foto')->getClientOriginalExtension();
                Storage::disk('storage_clasificados')->put('foto_'.$fecha.'.'.$request->file('foto')->getClientOriginalExtension() , file_get_contents($request->file('foto')) );
            }
            $json = json_encode( $request->all() );
            log_evento('Clasificado Update', $json);    
            $clasificados->save();

            session()->flash('flash_success_message', 'actualizado');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('clasificados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clasificados $clasificados,$id)
    {
        try {
            ClasificadoGaleria::where('clasificado_id',$id )->delete();
            
            $clasificado = Clasificados::find( $id );
            if ($clasificado) {
                $clasificado->delete();
            }
            $clasificado->delete();
            log_evento('Casificado Destroy', ['id' => $id]);
            session()->flash('flash_success_message', 'eliminado');
        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage());
        }
        return redirect('clasificados');
    }

    public function getClasificadoByEstado($estado)
    {
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        $clasificados = [];
        $clasificado_query = Clasificados::where('estado',$estado)->get();

        foreach ($clasificado_query as $value) {
            $clasificados[] =
            [
                'id' => $value->id,
                'casa' => $value->casa,
                'descripcion' => $value->descripcion,
                'foto' => $value->foto,
                'estado' => $value->estado,
                'whatsapp' => $value->whatsapp
            ];
        }

        return response()->json($clasificados, 200, $header);
    }

    public function getClasificado($id)
    {
        $clasificado = [];
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];

        $clasificados       = Clasificados::where('id',$id)->get();
        
        foreach ($clasificados as $value) {
            $clasificado[] = [
                'foto' => $value->foto,
                'casa' => $value->casa,
                'descripcion' => $value->descripcion,
                'whatsapp' => $value->whatsapp,
            ];
        }

        return response()->json($clasificado, 200, $header);
    }
}
