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
            'payment_from' => $this->faker->date(),
            'payment_to' => $this->faker->date(),
            'Payment_date' => now(),
            'Payment_due' => now(),
            'bill_cost' => $this->faker->numberBetween(1000, 8000),
            'month_name' => $this->faker->monthName('now'),
            'payment_status' => $this->faker->boolean(), // password
        ];
    }
}
