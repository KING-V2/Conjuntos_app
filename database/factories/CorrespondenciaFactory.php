<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Correspondencia>
 */
class CorrespondenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'casa_id' => rand(1,10),
            'luz' => rand(1,50),
            'agua' => rand(1,50),
            'gas' => rand(1,50),
            'mensajes' => rand(1,50),
            'paquetes'=> rand(1,50),
        ];
    }
}
