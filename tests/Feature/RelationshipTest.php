<?php

namespace Tests\Feature;

use App\Models\Coach;
use App\Models\Game;
use App\Models\Player;
use App\Models\Score;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_coach_has_team(): void
    {
        $coach = Coach::factory()->create();
        $team = Team::factory()->create(['coach_id' => $coach->coach_id]);
        $this->assertInstanceOf(Team::class, $coach->team);
        $this->assertEquals($team->team_id, $coach->team->team_id);
    }

    public function test_team_belongs_to_coach(): void
    {
        $coach = Coach::factory()->create();
        $team = Team::factory()->create(['coach_id' => $coach->coach_id]);
        $this->assertInstanceOf(Coach::class, $team->coach);
        $this->assertEquals($coach->coach_id, $team->coach->coach_id);
    }

    public function test_team_has_many_players(): void
    {
        $team = Team::factory()->create();
        Player::factory(3)->create(['team_id' => $team->team_id]);
        $this->assertCount(3, $team->players);
        $this->assertInstanceOf(Player::class, $team->players->first());
    }

    public function test_player_belongs_to_team(): void
    {
        $team = Team::factory()->create();
        $player = Player::factory()->create(['team_id' => $team->team_id]);
        $this->assertInstanceOf(Team::class, $player->team);
        $this->assertEquals($team->team_id, $player->team->team_id);
    }

    public function test_team_has_many_games(): void
    {
        $team = Team::factory()->create();
        Game::factory(2)->create(['team_id' => $team->team_id]);
        $this->assertCount(2, $team->games);
    }

    public function test_game_belongs_to_team(): void
    {
        $team = Team::factory()->create();
        $game = Game::factory()->create(['team_id' => $team->team_id]);
        $this->assertInstanceOf(Team::class, $game->team);
        $this->assertEquals($team->team_name, $game->team->team_name);
    }

    public function test_game_has_many_scores(): void
    {
        $game = Game::factory()->create();
        Score::factory(3)->create(['game_id' => $game->game_id]);
        $this->assertCount(3, $game->scores);
    }

    public function test_score_belongs_to_game(): void
    {
        $game = Game::factory()->create();
        $score = Score::factory()->create(['game_id' => $game->game_id]);
        $this->assertInstanceOf(Game::class, $score->game);
        $this->assertEquals($game->game_id, $score->game->game_id);
    }

    public function test_score_belongs_to_team(): void
    {
        $team = Team::factory()->create();
        $score = Score::factory()->create(['team_id' => $team->team_id]);
        $this->assertInstanceOf(Team::class, $score->team);
        $this->assertEquals($team->team_name, $score->team->team_name);
    }

    public function test_cascade_delete_team_removes_players(): void
    {
        $team = Team::factory()->create();
        $player = Player::factory()->create(['team_id' => $team->team_id]);
        $team->delete();
        $this->assertDatabaseMissing('players', ['player_id' => $player->player_id]);
    }

    public function test_cascade_delete_coach_prevents_orphan_teams(): void
    {
        $coach = Coach::factory()->create();
        Team::factory()->create(['coach_id' => $coach->coach_id]);
        // Deleting a coach with a team should not be possible if team depends on coach
        // (Teams table has cascadeOnDelete, so the team will be deleted)
        $coach->delete();
        $this->assertDatabaseMissing('teams', ['coach_id' => $coach->coach_id]);
    }

    public function test_score_model_has_no_timestamps(): void
    {
        $this->assertFalse((new Score())->timestamps);
    }
}
