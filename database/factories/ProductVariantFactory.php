<?php

namespace Database\Factories;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'title' => fake()->words(2, true),
            'sku' => strtoupper(fake()->bothLetters(6)),
            'price' => fake()->numberBetween(10000, 500000),
            'inventory' => fake()->numberBetween(0, 50),
            'status' => 1,
        ];
    }
}
