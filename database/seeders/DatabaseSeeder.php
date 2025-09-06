<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // ConjuntoSeeder::class,
            // BloqueSeeder::class,
            // ApartamentoSeeder::class,
            // ResidenteSeeder::class,
            // CorrespondenciaSeeder::class,
            RolesAndPermissionsSeeder::class
        ]);
    }
}
