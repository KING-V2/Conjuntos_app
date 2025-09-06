<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Encuestas\Foro;
use App\Models\Reservas\Reserva;
use App\Models\Trasteos\Trasteos;
use App\Models\Administracion\Residente;
use App\Models\Encuestas\EncuestasRespuestas;
use App\Models\Encuestas\RespuestaForo;
use App\Models\ModelHasRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        
        $rolesWithUsers = DB::table('model_has_roles')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('model_has_roles.role_id AS role_id', 'users.id as user_id', 'users.name as user_name', 'users.email as user_email', 'users.login_web as login_web', 'users.login_mobile as login_mobile', 'roles.name as role_name')
            ->where('model_type', User::class)
            ->get()
            ->groupBy('role_id');

            // dd( $rolesWithUsers );
            
        return view('admin.users.add', compact('users','roles', 'rolesWithUsers') );
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'login_mobile' => 'required',
            'rol' => 'required'
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'login_web' => $request->get('login_web') ? $request->get('login_web') : '0',
            'login_mobile' => $request->get('login_mobile') ? $request->get('login_mobile') : '0',
        ]);

        $user->assignRole($request->get('rol'));
        $user->save();

        return redirect('/users')->with('success', 'User has been added');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_id' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:6'
        ]);

        $user = User::find( $request->input('user_id') );
        $user->name = $request->get('name');
        // $user->email = $request->get('email');
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        return redirect('/users')->with('success', 'User has been updated');
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $encuestas = EncuestasRespuestas::where('usuario_id', $user->id)->get();
                foreach ($encuestas as $encuesta) {
                    $encuesta->delete();
                }

                $residentes = Residente::where('usuario_id', $user->id)->get();
                foreach ($residentes as $residente) {
                    $residente->delete();
                }
                
                $trasteos = Trasteos::where('usuario_id', $user->id)->get();
                foreach ($trasteos as $trasteo) {
                    $trasteo->delete();
                }

                $reservas = Reserva::where('usuario_id', $user->id)->get();
                foreach ($reservas as $reserva) {
                    $reserva->delete();
                }

                $respuesta_foros = RespuestaForo::where('usuario_id', $user->id)->get();
                foreach ($respuesta_foros as $respuesta) {
                    $respuesta->delete();
                }
            }
            $user->delete();

            session()->flash('flash_success_message', 'eliminado correctamente');
        }catch ( \Exception $exception){
            session()->flash('flash_error_message', $exception->getMessage() );
        }
        return redirect('users');
    }

    public function assignRole(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return redirect()->route('users.index');
    }

    public function modificarAccesosUsuario(Request $request){
        
        $header = ['Content-Type' => 'application/json','charset' => 'utf-8'];
        try {
            $user = User::find($request->input('user'));
            if ($request->input('origen') == 'web') {
                $user->login_web = ($request->input('valor') == '1' ? '0' : '1');
            }else{
                $user->login_mobile = ($request->input('valor') == '1' ? '0' : '1');
            }
            $user->save();

            return response()->json(['message' => 'Acceso '.$request->input('origen').' Actualizado'], 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage() ], 500, $header, JSON_UNESCAPED_UNICODE);
        }
    }   

}
