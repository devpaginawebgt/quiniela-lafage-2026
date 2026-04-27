<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CodigoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => strtoupper($this->faker->bothify('#####???')),
            // 'id_dependiente' => $this->faker->randomNumber(3,false),
            // 'nombre_dependiente' => $this->faker->name()
        ];
    }
}
