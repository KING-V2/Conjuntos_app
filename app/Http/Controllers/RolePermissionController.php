<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    // Mostrar la lista de roles y la opción para gestionar sus permisos
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles_permissions.index', compact('roles'));
    }

    // Mostrar el formulario de edición de permisos para un rol específico
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles_permissions.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    // Actualizar los permisos de un rol específico
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => 'array|nullable',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('roles.permissions.index')->with('success', 'Permisos actualizados correctamente.');
    }
}
