<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres'                => $this->faker->firstName(),
            'apellidos'              => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'numero_documento'       => $this->faker->unique()->numerify('#############'),
            // 'telefono'               => $this->faker->numerify('########'),
            'email'                  => $this->faker->unique()->safeEmail(),
            // 'direccion'              => $this->faker->city(),
            'pais_id'                => 1,
            'user_type_id'           => 1,
            'line_id'                => 1,
            'puntos'                 => 0,
            'status_user'            => 1,
            'password'               => Hash::make('FScomunica2'),
            'accepted_terms_version' => '0.1.0',
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('participant');
        });
    }

    /**
     * Tipo 1: Dependiente (con company y branch).
     */
    public function dependiente(int $paisId = 1): static
    {
        $companies = $paisId === 1 ? [1, 2] : [3, 4];

        return $this->state(fn () => [
            'pais_id'      => $paisId,
            'user_type_id' => 1,
            'company_id'   => $this->faker->randomElement($companies),
            'branch'       => 'Sucursal ' . $this->faker->numberBetween(1, 50),            
        ]);
    }

    /**
     * Tipo 2: Doctor (con colegiado, region, capital y visitor).
     */
    public function doctor(int $paisId = 1): static
    {
        return $this->state(fn () => [
            'pais_id'      => $paisId,
            'user_type_id' => 2,
            'company_id'   => null,
            'branch'       => null,
            'colegiado'    => (string) $this->faker->numberBetween(10000, 99999),
        ]);
    }
}
