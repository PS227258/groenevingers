<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderrowStatus;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orderrow>
 */
class OrderrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'status_id' => OrderrowStatus::factory(),
            'quantity' => fake()->randomFloat(0, 1, 9),
            'price' => Product::factory(),
        ];
    }
}
