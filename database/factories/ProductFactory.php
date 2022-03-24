<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Batch;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'batch_id' => Batch::all()->unique()->random()->id,
            'code' => date('Ymd') . $this->faker->unique()->numerify('#####'),
            'name' => $this->faker->unique()->lastName(),
            'color' => $this->faker->safeColorName(),
            'description' => $this->faker->unique()->realTextBetween(),
            'price' => $this->faker->numberBetween(100, 30000),
        ];
    }
}
