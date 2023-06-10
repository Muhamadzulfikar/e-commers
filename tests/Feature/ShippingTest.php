<?php

namespace Tests\Feature;

use App\Models\Shipping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexShipping()
    {
        $shippings = Shipping::factory()->count(3)->create();
        $response = $this->get('/shipping');
        $response->assertStatus(200);
        $response->assertViewHas('shippings', $shippings);
    }

    public function testCreateShipping()
    {
        $response = $this->post('/shipping', [
            'shipping_type' => 'Type A',
            'partner_name' => 'Partner A',
            'estimation_day' => '5 days',
            'price' => 1000,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('shippings', [
            'shipping_type' => 'Type A',
            'partner_name' => 'Partner A',
            'estimation_day' => '5 days',
            'price' => 1000,
        ]);
    }

    public function testEditShipping()
    {
        $shipping = Shipping::factory()->create();
        $response = $this->get("/shipping/{$shipping->id}/edit");
        $response->assertStatus(200);
        $response->assertViewHas('shipping', $shipping);
    }

    public function testUpdateShipping()
    {
        $shipping = Shipping::factory()->create();

        $response = $this->put("/shipping/{$shipping->id}", [
            'shipping_type' => 'Type B',
            'partner_name' => 'Partner B',
            'estimation_day' => '7 days',
            'price' => 1500,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('shippings', [
            'id' => $shipping->id,
            'shipping_type' => 'Type B',
            'partner_name' => 'Partner B',
            'estimation_day' => '7 days',
            'price' => 1500,
        ]);
    }

    public function testDeleteShipping()
    {
        $shipping = Shipping::factory()->create();
        $response = $this->delete("/shipping/{$shipping->id}");
        $response->assertRedirect();
        $this->assertDatabaseMissing('shippings', [
            'id' => $shipping->id,
        ]);
    }
}
