<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Score;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_id' => Game::inRandomOrder()->first()->game_id ?? Game::factory(),
            'team_id' => Team::inRandomOrder()->first()->team_id ?? Team::factory(),
            'points' => fake()->numberBetween(1, 3),
            'quarter' => fake()->numberBetween(1, 4),
            'score_type' => fake()->randomElement([
                'Field Goal',
                'Three Pointer',
                'Free Throw',
            ]),
            'score_time' => fake()->time(),
        ];
    }
}

