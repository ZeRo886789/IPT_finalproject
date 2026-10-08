<?php

namespace Database\Factories;

use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Coach>
 */
class CoachFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'coach_name' => fake()->name(),
            'contact_no' => fake()->phoneNumber(),
            'experience_year' => fake()->numberBetween(1, 20),
            'specialization' => fake()->randomElement([
                'Offense',
                'Defense',
                'Player Development',
                'Team Strategy',
            ]),
        ];
    }
}
