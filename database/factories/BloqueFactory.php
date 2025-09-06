<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bloque>
 */
class BloqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numerify('BLQ-#####'), // Código único
            'nombre' => $this->faker->unique()->numerify('Interior ###'),// Nombre aleatorio
            'conjunto_id' => 1,  
        ];
    }
}
