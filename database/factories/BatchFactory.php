<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => date('Ymdhis') . $this->faker->unique()->randomNumber(5),
            'manufacturing_date' => $this->faker->dateTimeBetween("-6 months")->format('d/m/Y')
        ];
    }
}
