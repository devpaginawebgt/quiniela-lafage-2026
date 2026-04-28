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
            'email'                  => $this->faker->unique()->safeEmail(),
            'pais_id'                => $this->faker->numberBetween(1, 6),
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
     * Si $paisId es null, se elige aleatoriamente entre los 6 países.
     * Solo los países 1 y 2 tienen companies asociadas; el resto recibe null.
     */
    public function dependiente(?int $paisId = null): static
    {
        return $this->state(function () use ($paisId) {
            $companyByCountry = [
                1 => [1, 2],
                2 => [3, 4],
            ];

            $pais = $paisId ?? $this->faker->numberBetween(1, 6);
            $companies = $companyByCountry[$pais] ?? null;

            return [
                'pais_id'      => $pais,
                'user_type_id' => 1,
                'company_id'   => $companies !== null
                    ? $this->faker->randomElement($companies)
                    : null,
                'branch'       => 'Sucursal ' . $this->faker->numberBetween(1, 50),
                'colegiado'    => null,
            ];
        });
    }

    /**
     * Tipo 2: Doctor (con colegiado, sin company ni branch).
     * Si $paisId es null, se elige aleatoriamente entre los 6 países.
     */
    public function doctor(?int $paisId = null): static
    {
        return $this->state(fn () => [
            'pais_id'      => $paisId ?? $this->faker->numberBetween(1, 6),
            'user_type_id' => 2,
            'company_id'   => null,
            'branch'       => null,
            'colegiado'    => (string) $this->faker->numberBetween(10000, 99999),
        ]);
    }
}
