<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => $this->faker->numberBetween(0, 10),
            'captain_id' => $this->faker->numberBetween(0, 10),
            'cost' => $this->faker->numberBetween(1000, 3000),
            'payment_method' => $this->faker->numberBetween(0, 2),
            'note' => $this->faker->numberBetween(0, 1),
            'status' => $this->faker->numberBetween(0, 1)


        ];
    }
}
