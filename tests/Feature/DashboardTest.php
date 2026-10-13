<?php

namespace Tests\Feature;

use App\Models\Coach;
use App\Models\Game;
use App\Models\Player;
use App\Models\Score;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_returns_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200)
            ->assertViewIs('dashboard');
    }

    public function test_dashboard_has_navbar_links(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200)
            ->assertSee(route('coaches.index'))
            ->assertSee(route('teams.index'))
            ->assertSee(route('players.index'))
            ->assertSee(route('games.index'))
            ->assertSee(route('scores.index'));
    }

    public function test_dashboard_title_is_correct(): void
    {
        $response = $this->get('/');
        $response->assertSee('Basketball League Management', false);
    }

    public function test_dashboard_displays_headings(): void
    {
        $response = $this->get('/');
        $response->assertSee('Basketball League Management', false);
    }
}
