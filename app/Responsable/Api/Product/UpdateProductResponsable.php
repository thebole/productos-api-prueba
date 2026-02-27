<?php

namespace App\Responsable\Api\Product;

use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Product\ProductRepository;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductResponsable implements Responsable
{
    private $repositories;
    private $request;

    public function __construct(UpdateProductRequest $request, ProductRepository $productRepository)
    {
        $this->request = $request;
        $this->repositories = (object) [
            'productRepository' => $productRepository
        ];
    }

    public function toResponse($request)
    {
        $product = $this->repositories->productRepository->updateProduct(
            $this->request->route('id'),
            $this->request->validated()
        );

        return response()->json([
            'message' => 'Product updated successfully.',
            'product' => $product,
        ], Response::HTTP_OK);
    }
}
