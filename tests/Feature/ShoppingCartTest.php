<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShoppingCartTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexShoppingCart()
    {
        $shoppingCarts = ShoppingCart::factory()->count(3)->create();
        $response = $this->get('/shopping-cart');
        $response->assertStatus(200);
        $response->assertViewHas('shoppingCarts', $shoppingCarts);
    }

    public function testCreateShoppingCart()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();
        $response = $this->post('/shopping-cart', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'quantity_sub_product' => 5,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('shopping_carts', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'quantity_sub_product' => 5,
        ]);
    }

    public function testEditShoppingCart()
    {
        $user = User::factory()->create();
        $shoppingCart = ShoppingCart::factory()->create();
        $response = $this->get("/shopping-cart/{$shoppingCart->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('shoppingCart', $shoppingCart);
    }

    public function testUpdateShoppingCart()
    {
        $user = User::factory()->create();
        $shoppingCart = ShoppingCart::factory()->create();
        $product = Product::factory()->create();

        $response = $this->put("/shopping-cart/{$shoppingCart->id}", [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'quantity_sub_product' => 7,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('shopping_carts', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'quantity_sub_product' => 7,
        ]);
    }

    public function testDeleteShoppingCart()
    {
        $shoppingCart = ShoppingCart::factory()->create();

        $response = $this->delete("/shopping-cart/{$shoppingCart->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('shopping_carts', [
            'id' => $shoppingCart->id,
        ]);
    }
}