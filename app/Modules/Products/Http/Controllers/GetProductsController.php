<?php

declare(strict_types=1);

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Http\Requests\GetProductsRequest;
use App\Modules\Products\Http\Resources\ProductResource;
use App\Modules\Products\Services\ProductService;

readonly class GetProductsController
{
    public function __construct(private ProductService $service)
    {
    }

    public function __invoke(GetProductsRequest $request)
    {
        return ProductResource::collection($this->service->getProducts());
    }
}
