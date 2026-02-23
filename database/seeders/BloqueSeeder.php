<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administracion\Bloque;
use App\Models\Administracion\Conjunto;

class BloqueSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener el primer conjunto o el que necesites
        $conjunto = Conjunto::first();
        
        if (!$conjunto) {
            $this->command->error('No hay conjuntos en la base de datos. Crea un conjunto primero.');
            return;
        }

        $bloques = [
            ['codigo' => 'BLQ-001', 'nombre' => 'Bloque A', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-002', 'nombre' => 'Bloque B', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-003', 'nombre' => 'Bloque C', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-004', 'nombre' => 'Bloque D', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-005', 'nombre' => 'Bloque E', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-006', 'nombre' => 'Bloque F', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-007', 'nombre' => 'Bloque G', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-008', 'nombre' => 'Bloque H', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-009', 'nombre' => 'Bloque I', 'conjunto_id' => $conjunto->id],
            ['codigo' => 'BLQ-010', 'nombre' => 'Bloque J', 'conjunto_id' => $conjunto->id],
        ];

        foreach ($bloques as $bloque) {
            Bloque::create($bloque);
        }
    }
}