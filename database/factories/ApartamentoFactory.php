<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartamento>
 */
class ApartamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numerify('RES-#####'), // Código único
            'nombre' => $this->faker->unique()->numerify('Apartamento ###'),// Nombre aleatorio
            'estado' => $this->faker->randomElement(['Asignada','Arriendo','Venta','Libre']), // Estado aleatorio
            'bloque_id' => rand(1,10),
        ];
    }
}
