<?php

declare(strict_types=1);

namespace App\Modules\Products\Services;

use App\Modules\Products\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

// Решил использовать обычный сервис паттерн без репозитория
// Хоть action паттерн мне нравится больше и чаще бывает выгоднее в больших проектах
// тут остановился на сервисе
class ProductService
{
    public function getProducts()
    {
        // Можно разнести по скоупам, или отдельным Filter классам
        // и затем собрать цепочку фильтров. но тут оверхед, поэтому так
        return QueryBuilder::for(Product::class)
            ->allowedFilters([
                'name',

                // преобразование в копейки оставим тут тоже для простоты и скорости выполнения тестового
                // а так можно было бы использовать brick/money пакет, либо обёртки под ларавель на его основе
                AllowedFilter::callback('price_from', static function (Builder $query, $value) {
                    $query->where('price', '>=', (int) ($value * 100));
                }),

                AllowedFilter::callback('price_to', static function (Builder $query, $value) {
                    $query->where('price', '<=', (int) ($value * 100));
                }),

                AllowedFilter::exact('in_stock'),

                AllowedFilter::callback('rating_from', static function (Builder $query, $value) {
                    $query->where('rating', '>=', $value);
                }),

                AllowedFilter::callback('rating_to', static function (Builder $query, $value) {
                    $query->where('rating', '<=', $value);
                }),
            ])
            ->allowedSorts(['price', 'rating', 'created_at'])
            ->allowedIncludes(['category'])
            ->jsonPaginate();
    }
}
