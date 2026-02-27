<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Responsable\Api\Product\AllProductResponsable;
use App\Responsable\Api\Product\CreateProductResponsable;
use App\Responsable\Api\Product\ShowProductResponsable;
use App\Responsable\Api\Product\UpdateProductResponsable;
use App\Responsable\Api\Product\DeleteProductResponsable;

class ProductController extends Controller
{
    public function index(AllProductResponsable $response): AllProductResponsable
    {
        return $response;
    }

    public function store(CreateProductResponsable $response): CreateProductResponsable
    {
        return $response;
    }

    public function show(ShowProductResponsable $response): ShowProductResponsable
    {
        return $response;
    }

    public function update(UpdateProductResponsable $response): UpdateProductResponsable
    {
        return $response;
    }

    public function destroy(DeleteProductResponsable $response): DeleteProductResponsable
    {
        return $response;
    }
}
