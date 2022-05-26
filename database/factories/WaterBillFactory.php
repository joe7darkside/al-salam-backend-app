<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WaterBillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bill_id' => $this->faker->numberBetween(0, 15),
            'cost' => $this->faker->numberBetween(0, 15),
        ];
    }
}
