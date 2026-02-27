<?php

namespace App\Responsable\Api\Product;

use App\Repositories\Product\ProductPricesRepository;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class ListProductPricesResponsable implements Responsable
{
    private $repositories;

    public function __construct(ProductPricesRepository $productPricesRepository)
    {
        $this->repositories = (object) [
            'productPricesRepository' => $productPricesRepository
        ];
    }

    public function toResponse($request)
    {
        if (!$request->user()->can('products.view.price')) {
            return response()->json([
                'message' => 'Unauthorized. You need the products.view.price permission.',
            ], Response::HTTP_FORBIDDEN);
        }

        $prices = $this->repositories->productPricesRepository->getListPriceByProductId(
            $request->route('id'),
            $request->input('per_page', 15),
            $request->input('page', 1)
        );

        return response()->json([
            'prices' => $prices,
        ], Response::HTTP_OK);
    }
}
