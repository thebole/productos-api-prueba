<?php

namespace App\Responsable\Api\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class ShowProductResponsable implements Responsable
{
    private $repositories;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repositories = (object) [
            'productRepository' => $productRepository
        ];
    }

    public function toResponse($request)
    {
        if (!$request->user()->can('products.view')) {
            return response()->json([
                'message' => 'Unauthorized. You need the products.view permission.',
            ], Response::HTTP_FORBIDDEN);
        }

        $product = $this->repositories->productRepository->getProductById($request->route('id'));

        return response()->json([
            'product' => $product,
        ], Response::HTTP_OK);
    }
}
