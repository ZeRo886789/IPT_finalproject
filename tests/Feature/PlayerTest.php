<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_index_returns_200(): void
    {
        Player::factory(3)->create();
        $response = $this->get(route('players.index'));
        $response->assertStatus(200)
            ->assertViewIs('players.index');
    }

    public function test_player_create_returns_200(): void
    {
        $response = $this->get(route('players.create'));
        $response->assertStatus(200);
    }

    public function test_player_store_validates_required_fields(): void
    {
        $response = $this->post(route('players.store'), []);
        $response->assertSessionHasErrors(['team_id', 'name', 'jersey_no', 'position', 'age']);
    }

    public function test_player_store_validates_jersey_no_range(): void
    {
        $team = Team::factory()->create();
        $response = $this->post(route('players.store'), [
            'team_id' => $team->team_id,
            'name' => 'Test Player',
            'jersey_no' => 100, // exceeds max of 99
            'position' => 'Guard',
            'age' => 25,
        ]);
        $response->assertSessionHasErrors(['jersey_no']);
    }

    public function test_player_store_validates_age_range(): void
    {
        $team = Team::factory()->create();
        $response = $this->post(route('players.store'), [
            'team_id' => $team->team_id,
            'name' => 'Test Player',
            'jersey_no' => 10,
            'position' => 'Guard',
            'age' => 15, // below min of 18
        ]);
        $response->assertSessionHasErrors(['age']);
    }

    public function test_player_store_valid_data_redirects_to_index(): void
    {
        $team = Team::factory()->create();
        $response = $this->post(route('players.store'), [
            'team_id' => $team->team_id,
            'name' => 'LeBron James',
            'jersey_no' => 23,
            'position' => 'Small Forward',
            'age' => 35,
        ]);
        $response->assertRedirect(route('players.index'));
        $this->assertDatabaseHas('players', [
            'name' => 'LeBron James',
            'jersey_no' => 23,
            'position' => 'Small Forward',
            'age' => 35,
        ]);
    }

    public function test_player_show_returns_200(): void
    {
        $player = Player::factory()->create();
        $response = $this->get(route('players.show', $player));
        $response->assertStatus(200)
            ->assertViewIs('players.show')
            ->assertViewHas('player', $player);
    }

    public function test_player_edit_returns_200(): void
    {
        $player = Player::factory()->create();
        $response = $this->get(route('players.edit', $player));
        $response->assertStatus(200)
            ->assertViewIs('players.edit');
    }

    public function test_player_update_valid_data_redirects_to_index(): void
    {
        $player = Player::factory()->create([
            'name' => 'Old Name',
        ]);
        $response = $this->put(route('players.update', $player), [
            'name' => 'New Name',
            'jersey_no' => 7,
            'position' => 'Center',
            'age' => 28,
        ]);
        $response->assertRedirect(route('players.index'));
        $this->assertDatabaseHas('players', [
            'player_id' => $player->player_id,
            'name' => 'New Name',
        ]);
    }

    public function test_player_destroy_redirects_to_index(): void
    {
        $player = Player::factory()->create();
        $response = $this->delete(route('players.destroy', $player));
        $response->assertRedirect(route('players.index'));
        $this->assertDatabaseMissing('players', ['player_id' => $player->player_id]);
    }

    public function test_player_show_nonexistent_returns_404(): void
    {
        $response = $this->get(route('players.show', 999999));
        $response->assertNotFound();
    }
}
