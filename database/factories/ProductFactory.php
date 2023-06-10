<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = uniqid() . '.jpg';
        $image = $this->faker->image();
        Storage::disk('public')->put($filename, file_get_contents($image));

        $file = new UploadedFile(
            $image,
            $filename,
            filesize($image),
            null,
            true // Set $test parameter to true for testing
        );

        $product = ProductCategory::factory()->create();
        return [
            'product_category_id' => $product->id,
            'product_name' => $this->faker->name,
            'product_price' => $this->faker->randomNumber(),
            'short_description' => $this->faker->text,
            'description' => $this->faker->text,
            'weight' => $this->faker->randomFloat(2, 0, 10),
            'image_product' => $file,
        ];
    }
}
