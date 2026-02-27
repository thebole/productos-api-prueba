<?php

namespace App\Responsable\Api\Product;

use App\Http\Requests\Product\StoreProductRequest;
use App\Repositories\Product\ProductRepository;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class CreateProductResponsable implements Responsable
{
    private $repositories;
    private $request;

    public function __construct(StoreProductRequest $request, ProductRepository $productRepository)
    {
        $this->request = $request;
        $this->repositories = (object) [
            'productRepository' => $productRepository
        ];
    }

    public function toResponse($request)
    {
        $product = $this->repositories->productRepository->createNewProduct($this->request->validated());

        return response()->json([
            'message' => 'Product created successfully.',
            'product' => $product,
        ], Response::HTTP_CREATED);
    }
}
