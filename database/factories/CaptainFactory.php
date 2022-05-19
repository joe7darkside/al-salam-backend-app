<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CaptainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'vehicle' => $this->faker->name(),
            'rate' => $this->faker->numberBetween(1, 5),
            'licence_plate' => $this->faker->name(),
            'password' => $this->faker->password(),
        ];
    }
}
