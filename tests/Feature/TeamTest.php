<?php

namespace Tests\Feature;

use App\Models\Coach;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_index_returns_200(): void
    {
        Team::factory(3)->create();
        $response = $this->get(route('teams.index'));
        $response->assertStatus(200)
            ->assertViewIs('teams.index');
    }

    public function test_team_create_returns_200(): void
    {
        $response = $this->get(route('teams.create'));
        $response->assertStatus(200);
    }

    public function test_team_store_validates_required_fields(): void
    {
        $response = $this->post(route('teams.store'), []);
        $response->assertSessionHasErrors(['coach_id', 'team_name', 'city', 'tel_no', 'founded_year']);
    }

    public function test_team_store_requires_valid_coach_id(): void
    {
        $response = $this->post(route('teams.store'), [
            'coach_id' => 999999, // nonexistent
            'team_name' => 'Test Team',
            'city' => 'Test City',
            'tel_no' => '555-0000',
            'founded_year' => 2020,
        ]);
        $response->assertSessionHasErrors(['coach_id']);
    }

    public function test_team_store_valid_data_redirects_to_index(): void
    {
        $coach = Coach::factory()->create();
        $response = $this->post(route('teams.store'), [
            'coach_id' => $coach->coach_id,
            'team_name' => 'Lakers',
            'city' => 'Los Angeles',
            'tel_no' => '555-0100',
            'founded_year' => 1947,
        ]);
        $response->assertRedirect(route('teams.index'));
        $this->assertDatabaseHas('teams', [
            'team_name' => 'Lakers',
            'city' => 'Los Angeles',
        ]);
    }

    public function test_team_show_returns_200(): void
    {
        $coach = Coach::factory()->create();
        $team = Team::factory()->create(['coach_id' => $coach->coach_id]);
        $response = $this->get(route('teams.show', $team));
        $response->assertStatus(200)
            ->assertViewIs('teams.show')
            ->assertViewHas('team', $team);
    }

    public function test_team_edit_returns_200(): void
    {
        $team = Team::factory()->create();
        $response = $this->get(route('teams.edit', $team));
        $response->assertStatus(200)
            ->assertViewIs('teams.edit');
    }

    public function test_team_update_valid_data_redirects_to_index(): void
    {
        $team = Team::factory()->create();
        $response = $this->put(route('teams.update', $team), [
            'team_name' => 'Updated Team',
            'city' => 'Updated City',
            'tel_no' => '555-9999',
            'founded_year' => 2000,
        ]);
        $response->assertRedirect(route('teams.index'));
        $this->assertDatabaseHas('teams', [
            'team_id' => $team->team_id,
            'team_name' => 'Updated Team',
        ]);
    }

    public function test_team_destroy_redirects_to_index(): void
    {
        $team = Team::factory()->create();
        $response = $this->delete(route('teams.destroy', $team));
        $response->assertRedirect(route('teams.index'));
        $this->assertDatabaseMissing('teams', ['team_id' => $team->team_id]);
    }

    public function test_team_show_nonexistent_returns_404(): void
    {
        $response = $this->get(route('teams.show', 999999));
        $response->assertNotFound();
    }
}
