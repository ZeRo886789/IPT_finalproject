<?php

namespace Database\Factories;

use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'coach_id' => Coach::inRandomOrder()->first()->coach_id ?? Coach::factory(),
            'team_name' => fake()->company(),
            'city' => fake()->city(),
            'tel_no' => fake()->phoneNumber(),
            'founded_year' => fake()->numberBetween(1980, 2025),
        ];
    }
}
