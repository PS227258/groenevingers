<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Orderrow;
use App\Models\Product;
use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_user_can_add_product_to_cart()
    {
        // Arange
        $order_id = 1;
        $status_id = 1;
        $quantity = 5;
        $product = Product::factory()->count(1)->create();

        // Act
        $this->post('/order', ['order_id' => $order_id, 'status_id' => $status_id, 'product_id' => $product[0]->id, 'quantity' => $quantity, 'product_price' => round($product[0]->price, 2)]);

        // Assert
        $this->assertDatabaseHas('orderrows', [
            'order_id' => $order_id,
            'status_id' => $status_id,
            'product_id' => $product[0]->id,
            'quantity' => $quantity,
            'price' => round($product[0]->price * $quantity, 2),
        ]);
    }

    public function test_user_can_remove_product_from_cart()
    {
        // Arange
        $orderrow_id = 1;
        $order_id = 1;
        $orderrow = Orderrow::find($orderrow_id);
        $order = Order::find($order_id);

        // Act
        $this->delete(route('orderrow.destroy', $orderrow_id));

        // Assert
        $this->assertDatabaseMissing('orderrows', [
            'id' => $orderrow_id,
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order_id,
            'price' => $order->price - $orderrow->price,
        ]);
    }
}
