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
            'Payment_date' => now(),
            'month_name'=>$this->faker->monthName(),
            'payment_status' => $this->faker->boolean(), // password
        ];
    }
}
