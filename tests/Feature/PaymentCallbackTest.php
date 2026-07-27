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

class PaymentCallbackTest extends TestCase
{
    use RefreshDatabase;

    private ProductVariant $variant;
    private Order $order;

    private function createPendingOrder(int $inventory = 5, int $quantity = 2): void
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
            'inventory' => $inventory,
            'status' => 1,
        ]);
        User::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => 'password']);

        $this->order = Order::create([
            'user_id' => 1,
            'total_amount' => 200000,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $this->order->id,
            'product_variant_id' => $this->variant->id,
            'quantity' => $quantity,
            'unit_price' => 100000,
            'total_price' => 200000,
        ]);

        $this->variant->decrement('inventory', $quantity);
    }

    public function test_successful_payment_callback(): void
    {
        $this->createPendingOrder(inventory: 5, quantity: 2);

        $response = $this->postJson('/api/v1/orders/payments/callback', [
            'order_id' => $this->order->id,
            'transaction_id' => 'TXN-12345',
            'status' => 'success',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $this->order->id,
            'status' => 'processing',
            'transaction_id' => 'TXN-12345',
        ]);

        $this->assertDatabaseHas('product_variants', [
            'id' => $this->variant->id,
            'inventory' => 3,
        ]);
    }

    public function test_failed_payment_callback_restores_inventory(): void
    {
        $this->createPendingOrder(inventory: 5, quantity: 2);

        $response = $this->postJson('/api/v1/orders/payments/callback', [
            'order_id' => $this->order->id,
            'transaction_id' => 'TXN-67890',
            'status' => 'failed',
            'failure_reason' => 'Insufficient funds',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $this->order->id,
            'status' => 'cancelled',
            'transaction_id' => 'TXN-67890',
            'failure_reason' => 'Insufficient funds',
        ]);

        $this->assertDatabaseHas('product_variants', [
            'id' => $this->variant->id,
            'inventory' => 5,
        ]);
    }
}
