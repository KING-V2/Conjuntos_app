<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Administracion\Residente;
use App\Models\Administracion\Conjunto;
use App\Models\Administracion\InformacionConjunto;
use App\Models\Configuracion\LogUsuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirigir al usuario a la página deseada si la autenticación fue exitosa
            $user = auth()->user();
            $log_user = new LogUsuarios();
            $log_user->usuario = $user->name;
            $log_user->fecha = date('Y-m-d H:i:s');
            $log_user->save();

            // return redirect()->intended('/empleados');  // Ajusta esta ruta según tu proyecto
        }

        // Si falla la autenticación, retornar un error
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);        

        return redirect('/empleados');
    }

    public function logout(Request $request)
    {
        // Revoca el token actual del usuario autenticado
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function login_mobile(Request $request)
    {
        date_default_timezone_set('America/Bogota');

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ( isset($user) && !$user->login_mobile ) {
            throw ValidationException::withMessages([
                'email' => __('auth.access_denied'),
            ]);
        }else{
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }
        }
       
        $residente = Residente::where('usuario_id', $user->id)->first();
        $info_residente = [];
        if (isset($residente)) {
            $info_residente = [
                'casa_id' => $residente->casas->id,
            ];
        }
                
        $log_user = new LogUsuarios();
        $log_user->usuario = $user->name;
        $log_user->fecha = date('Y-m-d H:i:s');
        $log_user->save();


        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'info_residente' => $info_residente
        ]);
    }
}
