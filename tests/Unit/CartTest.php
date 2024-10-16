<?php

namespace Tests\Unit;

use App\Models\Categorie;
use App\Models\Order;
use App\Models\Orderrow;
use App\Models\OrderrowStatus;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_product_to_cart()
    {
        // Arange
        $status = OrderrowStatus::factory()->create();
        $status_id = $status->id;

        $order = Order::factory()->create();
        $order_id = $order->id;

        $quantity = 5;

        // Create categories and products
        $product = Product::factory()->for(Categorie::factory()->create())->create();

        // Act
        $this->post('/order', ['order_id' => $order_id, 'status_id' => $status_id, 'product_id' => $product->id, 'quantity' => $quantity, 'product_price' => round($product->price, 2)]);

        // Assert
        $this->assertDatabaseHas('orderrow_statuses', [
            'id' => $status_id,
        ]);

        $this->assertDatabaseHas('orderrows', [
            'status_id' => $status_id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => round($product->price * $quantity, 2),
        ]);
    }

    public function test_user_can_remove_product_from_cart()
    {
        // Arange
        $orderrow = Orderrow::factory()->create();
        $orderrow_id = $orderrow->id;

        $this->assertDatabaseHas('orderrows', [
            'id' => $orderrow_id,
        ]);

        // Act
        $this->delete(route('orderrow.destroy', $orderrow_id));

        // Assert
        $this->assertDatabaseMissing('orderrows', [
            'id' => $orderrow_id,
        ]);
    }
}
