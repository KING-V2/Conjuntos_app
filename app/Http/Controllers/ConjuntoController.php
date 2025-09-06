<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConjuntoRequest;
use App\Http\Requests\UpdateConjuntoRequest;
use App\Models\Administracion\Bloque;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\Casas;
use App\Models\Correspondencia\Correspondencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class ConjuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conjuntos = Conjunto::all();
        $administradores = User::all();
        return view('admin.conjuntos.add',
            [
                'conjuntos' => $conjuntos ? $conjuntos : [],
                'administradores' => $administradores
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
    public function store(StoreConjuntoRequest $request)
    {
        try {
            $fecha              = date('Ymdhis');
            
            $icono              = $request->file('icono');
            $logo               = $request->file('logo');
            $icono_name         = 'icono_'.$fecha.'.'.$icono->getClientOriginalExtension();
            $logo_name          = 'logo_'.$fecha.'.'.$logo->getClientOriginalExtension();

            $conjunto   = new Conjunto();
            $conjunto->nombre           = $request->input('nombre');
            $conjunto->direccion        = $request->input('direccion');
            $conjunto->nit              = $request->input('nit');
            $conjunto->administrador_id = $request->input('administrador_id');
            $conjunto->icono            = $icono_name;
            $conjunto->logo             = $logo_name;

            Storage::disk('storage_iconos')->put($icono_name, file_get_contents($icono));
            Storage::disk('storage_logos')->put($logo_name, file_get_contents($logo));
            Session::put('icono', $icono_name ); 
            Session::put('logo', $logo_name); 
            Session::put('conjunto', $conjunto->nombre ); 
            
            $save_conjunto = $conjunto->save();
            $json = json_encode( $request->all() );
            log_evento('Store Conjunto, Bloques y Aptos', $json);

            if ($save_conjunto) {
                $no_casas = $request->input('numero_casas');

                for ($i = 1; $i <= $no_casas; $i++) {
                    $casa = new Casas();
                    $casa->conjunto_id = $conjunto->id;
                    $casa->nombre = 'Casa '.$i;
                    $casa->codigo = 'CA-' . date('his') . $i;
                    $save_casa = $casa->save();
                    log_evento('Store casa - Conjunto', [
                        'id' => $casa->id,
                        'nombre' => $casa->nombre,
                        'codigo' => $casa->codigo,
                        'conjunto_id' => $casa->conjunto_id,
                    ]);
                }
            }

            session()->flash('flash_success_message', 'Conjunto adicionado correctamente');
        } catch (\Exception $exception) {
            session()->flash('flash_error_message', $exception->getMessage());
            return back()->withInput();
        }

        return redirect('conjuntos');
    }


    /**
     * Display the specified resource.
     */
    public function show(Conjunto $conjunto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conjunto $conjunto, $id)
    {
        try{
            $conjunto = Conjunto::findOrFail( $id );
            $administrador = User::all();
            return view('admin.conjuntos.edit',
                [
                    'conjunto' => $conjunto,
                    'administradores' => $administrador
                ]
            );

        } catch (\Throwable $th) {
            session()->flash('flash_error_message', $th->getMessage() );
        }
        return redirect('conjuntos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConjuntoRequest $request, Conjunto $conjunto)
    {
        
        $fecha              = date('Ymdhis');
        try {
            $conjunto                   = Conjunto::findOrFail( $request->input('conjunto_id') );
            $conjunto->nombre           = $request->input('nombre');
            $conjunto->direccion        = $request->input('direccion');
            $conjunto->nit              = $request->input('nit');
            $conjunto->administrador_id = $request->input('administrador_id');
            
            if( !empty( $request->file('icono') ) ){
                $icono = $request->file('icono');
                $icono_name         = 'icono_'.$fecha.'.'.$icono->getClientOriginalExtension();
                $conjunto->icono    = $icono_name;
                Storage::disk('storage_iconos')->put($icono_name , file_get_contents($icono) );
                Session::put('icono', $icono_name ); 
            }
            
            if( !empty( $request->file('logo') )){
                $logo = $request->file('logo');
                $logo_name          = 'logo_'.$fecha.'.'.$logo->getClientOriginalExtension();
                $conjunto->logo             = $logo_name;
                Storage::disk('storage_logos')->put($logo_name , file_get_contents($logo) );
                Session::put('logo', $logo_name ); 
            }

            $conjunto->save();
            $json = json_encode( $request->all() );
            log_evento('Update Conjunto', $json);
            session()->flash('flash_success_message', 'actualizado correctamente');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('conjuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conjunto $conjunto,$id)
    {
        try {
            $conjunto = Conjunto::find( $id );
            $conjunto->delete();
            log_evento('Destroy Conjunto', ['id' => $id]);
            session()->flash('flash_success_message', 'eliminado correctamente');
        } catch (\Throwable $th) {
            // session()->flash('flash_error_message', $th->getMessage());
            session()->flash('flash_error_message', 'No es posible eliminar la información del conjunto residencial.');
        }
        return redirect('conjuntos');
    }
}
