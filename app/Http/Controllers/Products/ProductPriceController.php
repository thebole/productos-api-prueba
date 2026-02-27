<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Responsable\Api\Product\ListProductPricesResponsable;
use App\Responsable\Api\Product\CreateProductPriceResponsable;

class ProductPriceController extends Controller
{
    public function index(ListProductPricesResponsable $response): ListProductPricesResponsable
    {
        return $response;
    }

    public function store(CreateProductPriceResponsable $response): CreateProductPriceResponsable
    {
        return $response;
    }
}
