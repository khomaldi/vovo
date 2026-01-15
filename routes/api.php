<?php

declare(strict_types=1);

use App\Modules\Products\Http\Controllers\GetProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products', GetProductsController::class);
