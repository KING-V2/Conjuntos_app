<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Residente>
 */
class ResidenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conjunto_id' => 1,
            'casa_id' => rand(1,10),
            'usuario_id' => rand(1,100),
            'estado' => $this->faker->randomElement(['Activo','No Activo']), // Estado aleatorio
            'tipo_residente' => $this->faker->randomElement(['Propietario','Arrendatario']), // Estado aleatorio
        ];
    }
}
