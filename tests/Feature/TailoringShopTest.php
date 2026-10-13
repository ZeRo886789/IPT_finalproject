<?php
namespace Tests\Feature;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TailoringShopTest extends TestCase {
    use RefreshDatabase;
    public function test_dashboard_is_available(): void {
        $this->get('/')->assertOk()->assertSee('Tailoring Shop Management');
    }
    public function test_customer_can_be_created(): void {
        $response=$this->post('/customers',['name'=>'Test Customer','phone'=>'09171234567','email'=>'test@example.com']);
        $response->assertRedirect('/customers');
        $this->assertDatabaseHas('customers',['name'=>'Test Customer','phone'=>'09171234567']);
    }
}
