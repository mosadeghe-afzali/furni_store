<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantAttributeValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    use RefreshDatabase;

    private function createColorAttribute(): Attribute
    {
        return Attribute::create(['name' => 'Color', 'type' => 1, 'unit' => '', 'status' => 1]);
    }

    private function createProducts()
    {
        $category = Category::create(['name' => 'Living Room', 'slug' => 'living-room', 'status' => 1]);

        $product1 = Product::create([
            'category_id' => $category->id,
            'name' => 'Sofa',
            'slug' => 'sofa',
            'description' => 'A sofa',
            'status' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $product1->id,
            'title' => 'Red',
            'sku' => 'SOFA-RED',
            'price' => 100000,
            'inventory' => 5,
            'status' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $product1->id,
            'title' => 'Blue',
            'sku' => 'SOFA-BLU',
            'price' => 120000,
            'inventory' => 0,
            'status' => 1,
        ]);

        $product2 = Product::create([
            'category_id' => $category->id,
            'name' => 'Chair',
            'slug' => 'chair',
            'description' => 'A chair',
            'status' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $product2->id,
            'title' => 'Green',
            'sku' => 'CHAIR-GRN',
            'price' => 50000,
            'inventory' => 10,
            'status' => 1,
        ]);

        $product3 = Product::create([
            'category_id' => $category->id,
            'name' => 'Table',
            'slug' => 'table',
            'description' => 'A table',
            'status' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $product3->id,
            'title' => 'White',
            'sku' => 'TABLE-WHT',
            'price' => 200000,
            'inventory' => 0,
            'status' => 1,
        ]);

        return [$product1, $product2, $product3];
    }

    public function test_can_list_products(): void
    {
        $this->createProducts();

        $response = $this->getJson('/api/v1/products');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'response.data')
            ->assertJsonStructure([
                'response' => [
                    'data' => [
                        '*' => ['id', 'name', 'slug', 'min_price', 'max_price', 'has_inventory', 'colors'],
                    ],
                    'meta' => ['total', 'count', 'per_page', 'current_page', 'total_pages'],
                ],
            ]);
    }

    public function test_filter_by_min_price(): void
    {
        $this->createProducts();

        $response = $this->getJson('/api/v1/products?min_price=80000');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'response.data');

        $names = collect($response->json('response.data'))->pluck('name')->toArray();
        $this->assertContains('Sofa', $names);
        $this->assertContains('Table', $names);
        $this->assertNotContains('Chair', $names);
    }

    public function test_filter_by_max_price(): void
    {
        $this->createProducts();

        $response = $this->getJson('/api/v1/products?max_price=80000');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'response.data')
            ->assertJsonPath('response.data.0.name', 'Chair');
    }

    public function test_filter_by_has_inventory_1(): void
    {
        $this->createProducts();

        $response = $this->getJson('/api/v1/products?has_inventory=1');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'response.data');

        $names = collect($response->json('response.data'))->pluck('name')->toArray();
        $this->assertContains('Sofa', $names);
        $this->assertContains('Chair', $names);
        $this->assertNotContains('Table', $names);
    }

    public function test_filter_by_has_inventory_0(): void
    {
        $this->createProducts();

        $response = $this->getJson('/api/v1/products?has_inventory=0');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'response.data')
            ->assertJsonPath('response.data.0.name', 'Table');
    }

    public function test_filter_by_category(): void
    {
        $this->createProducts();

        $response = $this->getJson('/api/v1/products?category=living-room');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'response.data');
    }

    public function test_filter_by_color(): void
    {
        $this->createProducts();

        $attribute = $this->createColorAttribute();

        $product = Product::where('slug', 'sofa')->first();
        $variant = ProductVariant::where('product_id', $product->id)->first();

        $colorValue = AttributeValue::create(['attribute_id' => $attribute->id, 'value' => 'قرمز']);

        VariantAttributeValue::create([
            'variant_id' => $variant->id,
            'attribute_value_id' => $colorValue->id,
        ]);

        $response = $this->getJson('/api/v1/products?color=' . urlencode('قرمز'));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'response.data')
            ->assertJsonPath('response.data.0.name', 'Sofa');
    }

    public function test_multiple_filters_combined(): void
    {
        $this->createProducts();

        $response = $this->getJson('/api/v1/products?min_price=80000&has_inventory=1');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'response.data')
            ->assertJsonPath('response.data.0.name', 'Sofa');
    }
}
