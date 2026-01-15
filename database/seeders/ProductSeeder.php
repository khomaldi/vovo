<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Наполнить таблицы categories и products
     *
     * Тут я сделал такие данные:
     * Всего категорий 3.
     * Всего товаров 10.
     *
     * 1 категория — 1 товар
     * 2 категория — 2 товара
     * 3 категория — 3 товара
     * без категории — 4 товара
     *
     * @return void
     */
    public function run(): void
    {
        Category::factory()->has(Product::factory()->count(1))->create();

        Category::factory()->has(Product::factory()->count(2))->create();

        Category::factory()->has(Product::factory()->count(3))->create();

        Product::factory()->count(4)->withoutCategory()->create();
    }
}
