<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
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
            'type' => $this->faker->numberBetween(0, 2),
            'Payment_date' => now(),
            'payment_status' => $this->faker->boolean(), // password
            'price' => $this->faker->randomNumber(),
        ];
    }
}
