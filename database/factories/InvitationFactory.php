<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationFactory extends Factory
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
            'guest_id' => $this->faker->numberBetween(0, 10),
            'permission' => $this->faker->numberBetween(0, 2),
        ];
    }
}
