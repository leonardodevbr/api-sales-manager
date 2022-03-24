<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->unique()->random()->id,
            'name' => $this->faker->unique()->name,
            'cnpj' => $this->faker->unique()->numerify('##.###.###/####-##'),
        ];
    }
}
