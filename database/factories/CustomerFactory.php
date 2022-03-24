<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'cpf' => $this->faker->unique()->numerify('###.###.###-##'),
            'birthdate' => $this->faker->dateTimeBetween("-68 years", "-18 years")->format('d/m/Y')
        ];
    }
}
