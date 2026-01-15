<?php

namespace App\Modules\Products\Models;

use App\Modules\Categories\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->firstName();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => $this->faker->numberBetween(10000, 1000000),
            'category_id' => Category::factory(),
            'in_stock' => $this->faker->boolean(80),
            'rating' => $this->faker->randomFloat(2, 1, 5),
            'created_at' => $this->faker->dateTimeBetween('-1 week'),
            'updated_at' => $this->faker->dateTimeBetween('-1 week'),
        ];
    }

    public function withoutCategory(): self
    {
        return $this->state(fn(array $attributes) => ['category_id' => null]);
    }
}
