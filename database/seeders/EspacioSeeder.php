<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Espacio;

class EspacioSeeder extends Seeder
{
    public function run()
    {
        // Primeros 40 espacios disponibles
        for ($i = 1; $i <= 40; $i++) {
            Espacio::create([
                'numero' => $i,
                'estado' => 'disponible',
            ]);
        }

        
        for ($i = 41; $i <= 45; $i++) {
            Espacio::create([
                'numero' => $i,
                'estado' => 'ocupado',
            ]);
        }

        
        for ($i = 46; $i <= 50; $i++) {
            Espacio::create([
                'numero' => $i,
                'estado' => 'reservado',
            ]);
        }
    }
}