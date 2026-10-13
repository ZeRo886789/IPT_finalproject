<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_index_returns_200(): void
    {
        Game::factory(3)->create();
        $response = $this->get(route('games.index'));
        $response->assertStatus(200)
            ->assertViewIs('games.index');
    }

    public function test_game_create_returns_200(): void
    {
        $response = $this->get(route('games.create'));
        $response->assertStatus(200);
    }

    public function test_game_store_validates_required_fields(): void
    {
        $response = $this->post(route('games.store'), []);
        $response->assertSessionHasErrors(['team_id', 'game_date', 'venue', 'time', 'game_status']);
    }

    public function test_game_store_requires_valid_team_id(): void
    {
        $response = $this->post(route('games.store'), [
            'team_id' => 999999,
            'game_date' => '2026-10-15',
            'venue' => 'Arena',
            'time' => '19:00:00',
            'game_status' => 'Scheduled',
        ]);
        $response->assertSessionHasErrors(['team_id']);
    }

    public function test_game_store_validates_time_format(): void
    {
        $team = Team::factory()->create();
        $response = $this->post(route('games.store'), [
            'team_id' => $team->team_id,
            'game_date' => '2026-10-15',
            'venue' => 'Arena',
            'time' => 'invalid-time',
            'game_status' => 'Scheduled',
        ]);
        $response->assertSessionHasErrors(['time']);
    }

    public function test_game_store_valid_data_redirects_to_index(): void
    {
        $team = Team::factory()->create();
        $response = $this->post(route('games.store'), [
            'team_id' => $team->team_id,
            'game_date' => '2026-10-15',
            'venue' => 'City Gym',
            'time' => '19:00:00',
            'game_status' => 'Scheduled',
        ]);
        $response->assertRedirect(route('games.index'));
        $this->assertDatabaseHas('games', [
            'team_id' => $team->team_id,
            'venue' => 'City Gym',
            'game_status' => 'Scheduled',
        ]);
    }

    public function test_game_show_returns_200(): void
    {
        $game = Game::factory()->create();
        $response = $this->get(route('games.show', $game));
        $response->assertStatus(200)
            ->assertViewIs('games.show')
            ->assertViewHas('game', $game);
    }

    public function test_game_edit_returns_200(): void
    {
        $game = Game::factory()->create();
        $response = $this->get(route('games.edit', $game));
        $response->assertStatus(200)
            ->assertViewIs('games.edit');
    }

    public function test_game_update_valid_data_redirects_to_index(): void
    {
        $game = Game::factory()->create();
        $response = $this->put(route('games.update', $game), [
            'venue' => 'Updated Venue',
            'game_status' => 'Completed',
        ]);
        $response->assertRedirect(route('games.index'));
        $this->assertDatabaseHas('games', [
            'game_id' => $game->game_id,
            'venue' => 'Updated Venue',
            'game_status' => 'Completed',
        ]);
    }

    public function test_game_destroy_redirects_to_index(): void
    {
        $game = Game::factory()->create();
        $response = $this->delete(route('games.destroy', $game));
        $response->assertRedirect(route('games.index'));
        $this->assertDatabaseMissing('games', ['game_id' => $game->game_id]);
    }

    public function test_game_show_nonexistent_returns_404(): void
    {
        $response = $this->get(route('games.show', 999999));
        $response->assertNotFound();
    }
}
