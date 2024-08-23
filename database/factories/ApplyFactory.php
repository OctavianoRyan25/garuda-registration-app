<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apply>
 */
class ApplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // range 1-50 increment
            'user_id' => $this->faker->numberBetween(1, 50),
            'no_register' => $this->faker->word,
            'status_id' => 1,
            'second_status_id' => 4,
            'document_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
