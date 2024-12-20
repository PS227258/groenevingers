<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'api_id' => $this->faker->unique()->numberBetween(1, 1000),
            'categorie_id' => Categorie::factory(),
            'stock_keeping_unit' => $this->faker->unique()->word,
            'name' => $this->faker->name(),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'supply' => $this->faker->numberBetween(1, 100),
            'img_src' => $this->faker->imageUrl(),
            'color' => $this->faker->colorName(),
            'height_cm' => $this->faker->numberBetween(1, 200),
            'width_cm' => $this->faker->numberBetween(1, 200),
            'depth_cm' => $this->faker->numberBetween(1, 200),
            'weight_gr' => round($this->faker->numberBetween(1, 5000), 2),
        ];
    }
}
