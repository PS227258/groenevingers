<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            "status_id" => OrderStatus::inRandomOrder()->first()->id,
            "customer_name" => fake()->name(),
            "email" => fake()->unique()->safeEmail(),
            "phone" => fake()->unique()->phoneNumber(),
            "address" => fake()->address(),
            "city" => fake()->city(),
            "zipcode" => fake()->postcode(),
            "price" => fake()->randomFloat(2, 10, 100),
            "created_at" => $createdAt,
            "updated_at" => $updatedAt,
        ];
    }
}
