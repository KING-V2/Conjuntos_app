<?php

namespace App\Http\Controllers\Parking;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Administracion\Casas;
use App\Models\Administracion\Bloque;
use App\Models\Administracion\Conjunto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Correspondencia\Correspondencia;

class SettingsController extends Controller
{
    public function index()
    {
        $conjunto = Conjunto::first();
        $administradores = User::role(['administrador'])->get();

        return view('admin.parking.settings', compact('conjunto', 'administradores'));
    }

    public function settingsUserUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'required',
            'password' => 'nullable|min:6'
        ]);

        $user = User::find( $request->input('user_id') );
        $user->name = $request->get('name');
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        return redirect('/users')->with('success', 'User has been updated');
    }

    /**
     * Update the specified resource in storage.
     */
    public function settingsConjuntosUpdate(UpdateConjuntoRequest $request, Conjunto $conjunto)
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
            log_evento('Update settings Conjunto', $json);
            session()->flash('flash_success_message', 'informacion de conjunto actualizado');
            
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('settings');
    }
}
