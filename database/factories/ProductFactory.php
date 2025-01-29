<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->unique()->word),
            'price' => $this->faker->numberBetween(1000, 99999),
            'description' => $this->faker->unique()->text(),
            'quantity' => $this->faker->numberBetween(10, 100),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
        ];
    }
}
