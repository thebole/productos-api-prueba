<?php

namespace App\Responsable\Api\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class DeleteProductResponsable implements Responsable
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
        if (!$request->user()->can('products.delete')) {
            return response()->json([
                'message' => 'Unauthorized. You need the products.delete permission.',
            ], Response::HTTP_FORBIDDEN);
        }

        $this->repositories->productRepository->deleteProduct($request->route('id'));

        return response()->json([
            'message' => 'Product deleted successfully.',
        ], Response::HTTP_OK);
    }
}
