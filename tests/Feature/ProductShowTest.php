<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantAttributeValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;
    private ProductVariant $variant;

    private function createProductWithRelations(): void
    {
        $category = Category::create(['name' => 'Living Room', 'slug' => 'living-room', 'status' => 1]);

        $this->product = Product::create([
            'category_id' => $category->id,
            'name' => 'Sofa',
            'slug' => 'sofa',
            'description' => 'A comfortable sofa',
            'status' => 1,
        ]);

        $this->variant = ProductVariant::create([
            'product_id' => $this->product->id,
            'title' => 'Red',
            'sku' => 'SOFA-RED',
            'price' => 100000,
            'inventory' => 5,
            'status' => 1,
        ]);

        $attribute = Attribute::create(['name' => 'Color', 'type' => 1, 'unit' => '', 'status' => 1]);
        $colorValue = AttributeValue::create(['attribute_id' => $attribute->id, 'value' => 'قرمز']);

        VariantAttributeValue::create([
            'variant_id' => $this->variant->id,
            'attribute_value_id' => $colorValue->id,
        ]);

        $this->variant->media()->create([
            'path' => '/images/sofa-red.jpg',
            'type' => Media::TYPE_IMAGE,
            'alt' => 'Red Sofa Variant',
            'status' => Media::STATUS_ACTIVE,
        ]);
    }

    public function test_can_show_product(): void
    {
        $this->createProductWithRelations();

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'response' => [
                    'id',
                    'category_id',
                    'name',
                    'slug',
                    'description',
                    'status',
                    'status_text',
                    'created_at',
                    'variants' => [
                        '*' => [
                            'id',
                            'product_id',
                            'title',
                            'sku',
                            'price',
                            'inventory',
                            'status',
                            'attribute_values',
                            'media',
                        ],
                    ],
                ],
            ]);
    }

    public function test_show_product_returns_correct_data(): void
    {
        $this->createProductWithRelations();

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200);

        $data = $response->json('response');

        $this->assertEquals($this->product->id, $data['id']);
        $this->assertEquals('Sofa', $data['name']);
        $this->assertEquals('sofa', $data['slug']);
        $this->assertEquals('A comfortable sofa', $data['description']);
        $this->assertEquals(1, $data['status']);
        $this->assertEquals('فعال', $data['status_text']);
    }

    public function test_show_product_includes_category(): void
    {
        $this->createProductWithRelations();

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertJsonPath('response.category_id', $this->product->category_id);
    }

    public function test_show_product_includes_variants_with_attribute_values(): void
    {
        $this->createProductWithRelations();

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200);

        $variants = $response->json('response.variants');

        $this->assertCount(1, $variants);
        $this->assertEquals('Red', $variants[0]['title']);
        $this->assertEquals('SOFA-RED', $variants[0]['sku']);
        $this->assertEquals(100000, $variants[0]['price']);
        $this->assertEquals(5, $variants[0]['inventory']);

        $this->assertCount(1, $variants[0]['attribute_values']);
        $this->assertEquals('قرمز', $variants[0]['attribute_values'][0]['value']);
        $this->assertEquals('Color', $variants[0]['attribute_values'][0]['attribute_name']);
    }

    public function test_show_product_includes_variant_media(): void
    {
        $this->createProductWithRelations();

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200);

        $variantMedia = $response->json('response.variants.0.media');

        $this->assertCount(1, $variantMedia);
        $this->assertEquals('/images/sofa-red.jpg', $variantMedia[0]['path']);
        $this->assertEquals('Red Sofa Variant', $variantMedia[0]['alt']);
    }

    public function test_show_product_with_multiple_variants(): void
    {
        $category = Category::create(['name' => 'Living Room', 'slug' => 'living-room', 'status' => 1]);

        $this->product = Product::create([
            'category_id' => $category->id,
            'name' => 'Sofa',
            'slug' => 'sofa',
            'description' => 'A sofa',
            'status' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $this->product->id,
            'title' => 'Red',
            'sku' => 'SOFA-RED',
            'price' => 100000,
            'inventory' => 5,
            'status' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $this->product->id,
            'title' => 'Blue',
            'sku' => 'SOFA-BLU',
            'price' => 120000,
            'inventory' => 3,
            'status' => 1,
        ]);

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200);

        $variants = $response->json('response.variants');
        $this->assertCount(2, $variants);
    }

    public function test_show_nonexistent_product_returns_error(): void
    {
        $response = $this->getJson('/api/v1/products/99999');

        $response->assertStatus(422)
            ->assertJsonPath('data.errors.product', ['محصول یافت نشد.']);
    }

    public function test_show_product_with_no_variants_returns_empty_array(): void
    {
        $category = Category::create(['name' => 'Living Room', 'slug' => 'living-room', 'status' => 1]);

        $this->product = Product::create([
            'category_id' => $category->id,
            'name' => 'Sofa',
            'slug' => 'sofa',
            'description' => 'A sofa',
            'status' => 1,
        ]);

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertJsonPath('response.variants', []);
    }

    public function test_show_product_with_no_variant_media_returns_empty_array(): void
    {
        $category = Category::create(['name' => 'Living Room', 'slug' => 'living-room', 'status' => 1]);

        $this->product = Product::create([
            'category_id' => $category->id,
            'name' => 'Sofa',
            'slug' => 'sofa',
            'description' => 'A sofa',
            'status' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $this->product->id,
            'title' => 'Red',
            'sku' => 'SOFA-RED',
            'price' => 100000,
            'inventory' => 5,
            'status' => 1,
        ]);

        $response = $this->getJson('/api/v1/products/' . $this->product->id);

        $response->assertStatus(200)
            ->assertJsonPath('response.variants.0.media', []);
    }
}
