<?php

declare(strict_types=1);

namespace App\Modules\Products\Http\Requests;

use App\Modules\Products\Enums\ProductSortOption;
use Illuminate\Validation\Rule;

class GetProductsRequest
{
    public function rules(): array
    {
        // Фильтрацию, сортировку и пагинацию привёл к JSON API Specification
        return [
            'filter' => ['nullable', 'array'],
            'filter.name' => ['nullable', 'string', 'min:2', 'max:255'],
            'filter.price_from' => ['nullable', 'numeric', 'min:0'],
            'filter.price_to' => ['nullable', 'numeric', 'gte:filter.price_from'],
            'filter.in_stock' => ['nullable', 'boolean'],
            'filter.rating_from' => ['nullable', 'numeric', 'min:1', 'max:5'],
            'filter.rating_to' => ['nullable', 'numeric', 'min:1', 'max:5', 'gte:filter.rating_from'],
            'sort' => ['nullable', 'string', Rule::enum(ProductSortOption::class)],
            'include' => ['nullable', 'array'],
            'include.*' => ['nullable', 'string'],

            // для одного ресурса пойдёт, но вообще нужно вытащить для переиспользования
            'page.number' => ['nullable', 'numeric', 'min:1'],
            'page.size' => ['nullable', 'numeric', 'min:1'],
        ];
    }
}
