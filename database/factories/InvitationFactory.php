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
            'visiter_name' => $this->faker->name(),
            'permission' => $this->faker->numberBetween(0, 1),

        ];
    }
}
