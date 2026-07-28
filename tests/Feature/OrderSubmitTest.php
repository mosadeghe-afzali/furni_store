<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSubmitTest extends TestCase
{
    use RefreshDatabase;

    private ProductVariant $variant;

    private function createTestData(): void
    {
        $category = Category::create(['name' => 'Living Room', 'slug' => 'living-room', 'status' => 1]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Sofa',
            'slug' => 'sofa',
            'description' => 'A sofa',
            'status' => 1,
        ]);

        $this->variant = ProductVariant::create([
            'product_id' => $product->id,
            'title' => 'Red',
            'sku' => 'SOFA-RED',
            'price' => 100000,
            'inventory' => 5,
            'status' => 1,
        ]);

        User::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => 'password']);
    }

    public function test_successfully_submits_order(): void
    {
        $this->createTestData();

        $response = $this->postJson('/api/v1/orders', [
            'items' => [
                ['variant_id' => $this->variant->id, 'quantity' => 2],
            ],
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'response' => [
                    'transaction_id'
                ],
            ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => 1,
            'total_amount' => 200000,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_variant_id' => $this->variant->id,
            'quantity' => 2,
            'unit_price' => 100000,
            'total_price' => 200000,
        ]);

        $this->assertDatabaseHas('product_variants', [
            'id' => $this->variant->id,
            'inventory' => 3,
        ]);
    }

    public function test_fails_submit_order_due_to_lack_of_inventory(): void
    {
        $this->createTestData();

        $response = $this->postJson('/api/v1/orders', [
            'items' => [
                ['variant_id' => $this->variant->id, 'quantity' => 10],
            ],
        ]);

        $response->assertStatus(422);

        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);

        $this->assertDatabaseHas('product_variants', [
            'id' => $this->variant->id,
            'inventory' => 5,
        ]);
    }
}
