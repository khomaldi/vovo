<?php

declare(strict_types=1);

namespace App\Modules\Products\Http\Resources;

use App\Modules\Categories\Http\Resources\CategoryResource;
use App\Modules\Products\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            // при выводе price / 100. для простоты, не стал заморачиватсья с обёртками Money
            /** @var float */
            'price' => (float) $this->price / 100,
            'category_id' => $this->category_id,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'in_stock' => $this->in_stock,
            /** @var float */
            'rating' => $this->rating,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
