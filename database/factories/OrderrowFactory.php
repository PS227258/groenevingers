<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderrowStatus;
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
        $createdAt = $this->faker->dateTimeBetween('-15 days', 'now'); // Random date within the past year
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now'); // Random date between created_at and now

        return [
            "order_id" => Order::factory(),
            "product_id" => Product::inRandomOrder()->first()->id,
            "status_id" => OrderrowStatus::inRandomOrder()->first()->id,
            "quantity" => fake()->randomFloat(0, 1, 9),
            "price" => Product::inRandomOrder()->first()->price,
            "created_at" => $createdAt,
            "updated_at" => $updatedAt
        ];
    }
}
