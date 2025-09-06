<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Crear permisos 
        $permissions = [
            'modulo administracion',
            'modulo residentes',
            'modulo pqrs',
            'modulo clasificados',
            'modulo reservas',
            'modulo configuracion',
            'modulo empleados',
            'modulo trasteos',
            'modulo correspondencia',
            'modulo encuestas',
            'modulo informacion',
            'modulo emprendimientos',
            'conjunto',
            'informacion conjunto',
            'galeria conjunto',
            'bloques',
            'apartamentos',
            'usuarios',
            'residente',
            'empleado',
            'trasteo',
            'correspondencia',
            'encuestas',
            'directorio',
            'circulares',
            'manual',
            'foro',
            'respuesta foro',
            'clasificados',
            'clasificados galeria',
            'emprendimientos',
            'reserva',
            'zona comun',
            'permisos rol',
            'role',
            'log usuarios',
            'log sistema',
            'parqueaderos',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $superAdmin = Role::create(['name' => 'citoapp']);
        $admin = Role::create(['name' => 'admin']);
        $residente = Role::create(['name' => 'residente']);

        // Asignar todos los permisos al super_admin
        $superAdmin->givePermissionTo(Permission::all());

        // Asignar permisos específicos a otros roles
        $admin->givePermissionTo(
            [
                'modulo administracion',
                'modulo residentes',
                'modulo pqrs',
                'modulo clasificados',
                'modulo reservas',
                'modulo configuracion',
                'modulo empleados',
                'modulo trasteos',
                'modulo correspondencia',
                'modulo encuestas',
                'modulo informacion',
                'modulo emprendimientos',
                'conjunto',
                'informacion conjunto',
                'galeria conjunto',
                'bloques',
                'apartamentos',
                'usuarios',
                'residente',
                'empleado',
                'trasteo',
                'correspondencia',
                'encuestas',
                'directorio',
                'circulares',
                'manual',
                'foro',
                'respuesta foro',
                'clasificados',
                'clasificados galeria',
                'emprendimientos',
                'reserva',
                'zona comun',
                'permisos rol',
                'role',
                'log usuarios',
                'log sistema',
                'parqueaderos',
            ]
        );

        $residente->givePermissionTo(
            [
                'modulo administracion',
                'modulo residentes',
                'modulo pqrs',
                'modulo clasificados',
                'modulo reservas',
                'modulo configuracion',
                'modulo empleados',
                'modulo trasteos',
                'modulo correspondencia',
                'modulo encuestas',
                'modulo informacion',
                'modulo emprendimientos',
                'directorio',
                'empleado',
                'conjunto',
                'circulares',
                'manual',
                'emprendimientos',
                'galeria emprendimiento',
            ]
        );

        $user_super_admin = User::find(1);
        $user_super_admin->assignRole('citoapp');

        // $user_admin = User::find(2);
        // $user_admin->assignRole('admin');

        // $user_residente = User::find(3);
        // $user_residente->assignRole('residente');
    }
}
