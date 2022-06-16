<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GasBillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bill_id' => $this->faker->numberBetween(0,35),
            'cost' => $this->faker->numberBetween(1000, 8000),
        ];
    }
}
