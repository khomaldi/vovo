<?php

declare(strict_types=1);

namespace App\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->colorName();

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'is_active' => $this->faker->boolean(90),
            'created_at' => $this->faker->dateTimeBetween('-1 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month'),
        ];
    }
}
