<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
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
            'status' => 0,
        ]);

        OrderItem::create([
            'order_id' => $this->order->id,
            'product_variant_id' => $this->variant->id,
            'quantity' => $quantity,
            'unit_price' => 100000,
            'total_price' => 200000,
        ]);

        Payment::create([
            'order_id' => $this->order->id,
            'transaction_id' => 'TXN-12345',
            'amount' => 200000,
            'status' => Payment::PAYING,
        ]);

        $this->variant->decrement('inventory', $quantity);
    }

    public function test_successful_payment_callback(): void
    {
        $this->createPendingOrder(inventory: 5, quantity: 2);

        $response = $this->postJson('/api/v1/orders/payments/callback', [
            'order_id' => $this->order->id,
            'transaction_id' => 'TXN-12345',
            'ref_number' => 'REF-999',
            'status' => 'success',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $this->order->id,
            'status' => 1,
        ]);

        $this->assertDatabaseHas('payments', [
            'order_id' => $this->order->id,
            'status' => Payment::SUCCESSUL,
            'ref_number' => 'REF-999',
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
            'transaction_id' => 'TXN-12345',
            'ref_number' => 'REF-999',
            'status' => 'failed',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ]);

        $this->assertDatabaseHas('orders', [
            'id' => $this->order->id,
            'status' => -2,
        ]);

        $this->assertDatabaseHas('payments', [
            'order_id' => $this->order->id,
            'status' => Payment::CANCELD,
        ]);

        $this->assertDatabaseHas('product_variants', [
            'id' => $this->variant->id,
            'inventory' => 5,
        ]);
    }
}
