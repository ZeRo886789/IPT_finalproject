<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Score;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_score_index_returns_200(): void
    {
        Score::factory(3)->create();
        $response = $this->get(route('scores.index'));
        $response->assertStatus(200)
            ->assertViewIs('scores.index');
    }

    public function test_score_create_returns_200(): void
    {
        $response = $this->get(route('scores.create'));
        $response->assertStatus(200);
    }

    public function test_score_store_validates_required_fields(): void
    {
        $response = $this->post(route('scores.store'), []);
        $response->assertSessionHasErrors(['game_id', 'team_id', 'points', 'quarter', 'score_type', 'score_time']);
    }

    public function test_score_store_validates_quarter_range(): void
    {
        $game = Game::factory()->create();
        $team = Team::factory()->create();
        $response = $this->post(route('scores.store'), [
            'game_id' => $game->game_id,
            'team_id' => $team->team_id,
            'points' => 3,
            'quarter' => 5, // exceeds max of 4
            'score_type' => 'Field Goal',
            'score_time' => '10:30:00',
        ]);
        $response->assertSessionHasErrors(['quarter']);
    }

    public function test_score_store_requires_valid_game_id(): void
    {
        $team = Team::factory()->create();
        $response = $this->post(route('scores.store'), [
            'game_id' => 999999,
            'team_id' => $team->team_id,
            'points' => 2,
            'quarter' => 1,
            'score_type' => 'Field Goal',
            'score_time' => '10:30:00',
        ]);
        $response->assertSessionHasErrors(['game_id']);
    }

    public function test_score_store_valid_data_redirects_to_index(): void
    {
        $game = Game::factory()->create();
        $team = Team::factory()->create();
        $response = $this->post(route('scores.store'), [
            'game_id' => $game->game_id,
            'team_id' => $team->team_id,
            'points' => 3,
            'quarter' => 1,
            'score_type' => 'Three Pointer',
            'score_time' => '08:00:00',
        ]);
        $response->assertRedirect(route('scores.index'));
        $this->assertDatabaseHas('scores', [
            'game_id' => $game->game_id,
            'points' => 3,
            'quarter' => 1,
            'score_type' => 'Three Pointer',
        ]);
    }

    public function test_score_show_returns_200(): void
    {
        $score = Score::factory()->create();
        $response = $this->get(route('scores.show', $score));
        $response->assertStatus(200)
            ->assertViewIs('scores.show')
            ->assertViewHas('score', $score);
    }

    public function test_score_edit_returns_200(): void
    {
        $score = Score::factory()->create();
        $response = $this->get(route('scores.edit', $score));
        $response->assertStatus(200)
            ->assertViewIs('scores.edit');
    }

    public function test_score_update_valid_data_redirects_to_index(): void
    {
        $score = Score::factory()->create();
        $response = $this->put(route('scores.update', $score), [
            'points' => 5,
            'score_type' => 'Free Throw',
        ]);
        $response->assertRedirect(route('scores.index'));
        $this->assertDatabaseHas('scores', [
            'score_id' => $score->score_id,
            'points' => 5,
            'score_type' => 'Free Throw',
        ]);
    }

    public function test_score_destroy_redirects_to_index(): void
    {
        $score = Score::factory()->create();
        $response = $this->delete(route('scores.destroy', $score));
        $response->assertRedirect(route('scores.index'));
        $this->assertDatabaseMissing('scores', ['score_id' => $score->score_id]);
    }

    public function test_score_show_nonexistent_returns_404(): void
    {
        $response = $this->get(route('scores.show', 999999));
        $response->assertNotFound();
    }
}
