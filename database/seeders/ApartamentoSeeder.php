<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administracion\Apartamento;

class ApartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            Apartamento::create([
                'codigo' => 'RES-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'nombre' => 'Apartamento ' . $i,
                'estado' => collect(['Asignada', 'Arriendo', 'Venta', 'Libre'])->random(),
                'bloque_id' => rand(1, 10),
            ]);
        }
    }
}