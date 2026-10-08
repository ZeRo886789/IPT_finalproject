<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::inRandomOrder()->first()->team_id ?? Team::factory(),
            'game_date' => fake()->date(),
            'venue' => fake()->randomElement([
                'City Gymnasium',
                'Sports Complex',
                'Municipal Gym',
                'Basketball Arena',
            ]),
            'time' => fake()->time(),
            'game_status' => fake()->randomElement([
                'Scheduled',
                'Ongoing',
                'Completed',
                'Cancelled',
            ]),
        ];
    }
}
