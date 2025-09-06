<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    // Muestra la lista de usuarios con sus roles
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.user_roles.index', compact('users'));
    }

    // Muestra el formulario para asignar roles
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user_roles.edit', compact('user', 'roles'));
    }

    // Actualiza los roles del usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validamos que los roles sean un array
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',
        ]);

        // Sincronizamos los roles del usuario
        $user->syncRoles($request->roles);

        return redirect()->route('user_roles.index')->with('success', 'Roles asignados al usuario exitosamente.');
    }
}
