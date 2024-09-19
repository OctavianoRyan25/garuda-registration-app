<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'family_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'birth_date' => $this->faker->date(),
            'age' => $this->faker->numberBetween(1, 40),
            'gender' => $this->faker->word,
            'nationality' => $this->faker->country,
            'passport_number' => $this->faker->randomNumber(8),
            'department' => $this->faker->word,
            'profile_picture' => $this->faker->word,
            'passport' => $this->faker->word,
            'research_proposal' => $this->faker->word,
            'study_plan' => $this->faker->word,
            'english_proficiency' => $this->faker->word,
            'transcript' => $this->faker->word,
            'cv' => $this->faker->word,
            'medical_checkup' => $this->faker->word,
            'first_letter_of_recommendation' => $this->faker->word,
            'second_letter_of_recommendation' => $this->faker->word,
            'created_at' => $this->faker->dateTimeBetween('-3 years', 'now'),
        ];
    }
}
