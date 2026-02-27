<?php

namespace App\Responsable\Api\Product;

use App\Http\Requests\Product\StoreProductPriceRequest;
use App\Repositories\Product\ProductPricesRepository;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class CreateProductPriceResponsable implements Responsable
{
    private $repositories;
    private $request;

    public function __construct(StoreProductPriceRequest $request, ProductPricesRepository $productPricesRepository)
    {
        $this->request = $request;
        $this->repositories = (object) [
            'productPricesRepository' => $productPricesRepository
        ];
    }

    public function toResponse($request)
    {
        $price = $this->repositories->productPricesRepository->createNewPriceByProductId([
            'product_id' => $this->request->route('id'),
            'price' => $this->request->validated()['price'],
            'divisa_id' => $this->request->validated()['divisa_id'],
        ]);

        return response()->json([
            'message' => 'Product price created successfully.',
            'price' => $price,
        ], Response::HTTP_CREATED);
    }
}
