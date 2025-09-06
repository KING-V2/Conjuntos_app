<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'CitoApp',
            'email' => 'mi.conjunto.digitall@gmail.com',
            'login_web' => '1',
            'login_mobile' => '0',
            'password' => Hash::make('SuperAdmin123'),
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Administrador',
        //     'email' => 'administrador@citoapp.co',
        //     'login_web' => '1',
        //     'login_mobile' => '0',
        //     'password' => Hash::make('administrador'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Asistente Administrador',
        //     'email' => 'asistente_administrador@citoapp.co',
        //     'login_web' => '1',
        //     'login_mobile' => '0',
        //     'password' => Hash::make('asistente_administrador'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'residente',
        //     'email' => 'residente@citoapp.co',
        //     'login_web' => '0',
        //     'login_mobile' => '1',
        //     'password' => Hash::make('12345678'),
        // ]);

        // \App\Models\User::factory(10)->create();
    }
}
