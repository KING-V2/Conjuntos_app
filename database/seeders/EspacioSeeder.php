<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Espacio;

class EspacioSeeder extends Seeder
{
    public function run()
    {
        // Primeros 40 espacios disponibles
        for ($i = 1; $i <= 10; $i++) {
            Espacio::create([
                'numero' => $i,
                'estado' => 'disponible',
            ]);
        }

        
        for ($i = 11; $i <= 25; $i++) {
            Espacio::create([
                'numero' => $i,
                'estado' => 'ocupado',
            ]);
        }
    }
}