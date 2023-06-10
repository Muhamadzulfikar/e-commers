<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
     use RefreshDatabase;

    public function testCreateProduct()
    {
         $product = ProductCategory::factory()->create();

        $response = $this->post('/product', [
            'product_category_id' => $product->id,
            'product_name' => 'Contoh Product',
            'product_price' => 100,
            'short_description' => 'Deskripsi singkat',
            'weight' => 0.5,
            'image_product' => 'image.jpg',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'product_category_id' => $product->id,
            'product_name' => 'Contoh Product',
            'product_price' => 100,
            'short_description' => 'Deskripsi singkat',
            'weight' => 0.5,
            'image_product' => 'image.jpg',
        ]);
    }

    public function testEditProduct()
    {
        $product = Product::factory()->create();
        $response = $this->get("/product/{$product->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('product', $product);
    }

    public function testUpdateProduct()
    {
        $product = Product::factory()->create();

        $response = $this->put("/product/{$product->id}", [
            'product_name' => 'Product Baru',
            'product_price' => 200,
            'short_description' => 'Deskripsi baru',
            'weight' => 1.0,
            'image_product' => 'new_image.jpg',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', [
            'product_name' => 'Product Baru',
            'product_price' => 200,
            'short_description' => 'Deskripsi baru',
            'weight' => 1.0,
            'image_product' => 'new_image.jpg',
        ]);
    }

    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/product/{$product->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}