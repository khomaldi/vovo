<?php

declare(strict_types=1);

namespace App\Modules\Products\Enums;

enum ProductSortOption: string
{
    case PriceAsc = 'price';
    case PriceDesc = '-price';
    case RatingAsc = 'rating';
    case RatingDesc = '-rating';
    case CreatedAtAsc = 'created_at';
    case CreatedAtDesc = '-created_at';

    /**
     * Получить массив со всеми значениями
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
