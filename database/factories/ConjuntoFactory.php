<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conjunto>
 */
class ConjuntoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'nombre' => $this->faker->company(),           
                'direccion'=> $this->faker->address(),
                'nit'=> Str::random(10),
                'icono'=> 'icono_empresa.png',
                'logo'=> 'logo_empresa.png',
                'administrador_id' => 2
            ];

    }
}
