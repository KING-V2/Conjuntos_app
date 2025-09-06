<?php

namespace App\Http\Controllers\Auth;

use App\Models\Configuracion\LogUsuarios;
use App\Models\Administracion\Conjunto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/empleados';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $conjunto = Conjunto::first();
        // dd( $conjunto );
        
        return view('auth.login',
            [
                'logo' => $conjunto ? $conjunto->logo : 'logo_empresa.png'
            ]
        );
    }

    protected function login(Request $request)
    {
        date_default_timezone_set('America/Bogota');

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if ( isset($user) && !$user->login_web ) {
            throw ValidationException::withMessages([
                'access_denied' => __('auth.inactive'),
            ]);
        }

        if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) && auth()->user()->login_web ) {
            // Redirigir al usuario a la página deseada si la autenticación fue exitosa
            $user = auth()->user();
            $log_user = new LogUsuarios();
            $log_user->usuario = $user->name;
            $log_user->fecha = date('Y-m-d H:i:s');
            $log_user->save();

            $conjunto = Conjunto::first();
            if ( $conjunto )
            {
                Session::put('logo', $conjunto->logo ); 
                Session::put('icono', $conjunto->icono ); 
                Session::put('conjunto', $conjunto->nombre ); 
            }

            return redirect()->intended('/empleados');  // Ajusta esta ruta según tu proyecto
        }

        // Si falla la autenticación, retornar un error
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);        

        return redirect('/empleados');
    }


    protected function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
