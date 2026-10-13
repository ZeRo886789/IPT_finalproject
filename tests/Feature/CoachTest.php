<?php

namespace Tests\Feature;

use App\Models\Coach;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoachTest extends TestCase
{
    use RefreshDatabase;

    public function test_coach_index_returns_200(): void
    {
        Coach::factory(3)->create();
        $response = $this->get(route('coaches.index'));
        $response->assertStatus(200)
            ->assertViewIs('coaches.index');
    }

    public function test_coach_create_returns_200(): void
    {
        $response = $this->get(route('coaches.create'));
        $response->assertStatus(200)
            ->assertViewIs('coaches.create');
    }

    public function test_coach_store_validates_required_fields(): void
    {
        $response = $this->post(route('coaches.store'), []);
        $response->assertSessionHasErrors(['coach_name', 'contact_no', 'experience_year', 'specialization']);
    }

    public function test_coach_store_requires_integer_experience(): void
    {
        $response = $this->post(route('coaches.store'), [
            'coach_name' => 'Test Coach',
            'contact_no' => '123-4567',
            'experience_year' => 'not-a-number',
            'specialization' => 'Offense',
        ]);
        $response->assertSessionHasErrors(['experience_year']);
    }

    public function test_coach_store_valid_data_redirects_to_index(): void
    {
        $response = $this->post(route('coaches.store'), [
            'coach_name' => 'John Smith',
            'contact_no' => '555-1234',
            'experience_year' => 5,
            'specialization' => 'Defense',
        ]);
        $response->assertRedirect(route('coaches.index'));
        $this->assertDatabaseCount('coaches', 1);
        $this->assertDatabaseHas('coaches', [
            'coach_name' => 'John Smith',
            'contact_no' => '555-1234',
            'experience_year' => 5,
            'specialization' => 'Defense',
        ]);
    }

    public function test_coach_show_returns_200(): void
    {
        $coach = Coach::factory()->create();
        $response = $this->get(route('coaches.show', $coach));
        $response->assertStatus(200)
            ->assertViewIs('coaches.show')
            ->assertViewHas('coach', $coach);
    }

    public function test_coach_edit_returns_200(): void
    {
        $coach = Coach::factory()->create();
        $response = $this->get(route('coaches.edit', $coach));
        $response->assertStatus(200)
            ->assertViewIs('coaches.edit');
    }

    public function test_coach_update_valid_data_redirects_to_index(): void
    {
        $coach = Coach::factory()->create([
            'coach_name' => 'Old Name',
        ]);
        $response = $this->put(route('coaches.update', $coach), [
            'coach_name' => 'New Name',
            'contact_no' => '999-0000',
            'experience_year' => 10,
            'specialization' => 'Offense',
        ]);
        $response->assertRedirect(route('coaches.index'));
        $this->assertDatabaseHas('coaches', [
            'coach_id' => $coach->coach_id,
            'coach_name' => 'New Name',
        ]);
    }

    public function test_coach_destroy_redirects_to_index(): void
    {
        $coach = Coach::factory()->create();
        $response = $this->delete(route('coaches.destroy', $coach));
        $response->assertRedirect(route('coaches.index'));
        $this->assertDatabaseMissing('coaches', ['coach_id' => $coach->coach_id]);
    }

    public function test_coach_destroy_nonexistent_returns_404(): void
    {
        $response = $this->get(route('coaches.show', 999999));
        $response->assertNotFound();
    }
}
