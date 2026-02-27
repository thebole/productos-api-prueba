<?php

namespace App\Responsable\Api\Product;

use App\Repositories\Product\ProductRepository;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class AllProductResponsable implements Responsable
{

    private $repositories;
    /**
     * Create a new class instance.
     */
    public function __construct(ProductRepository $productRepository)
    {
        //
        $this->repositories = (object) [
            'productRepository'=> $productRepository
        ];
    }

    public function toResponse($request)
    {
        // 
        
        $allProducts = $this->repositories->productRepository->allProducts($request->perPage, $request->page);
        return response()->json([
            'products' => $allProducts,
            'page'  => $request->page,
            'perPage' => $request->perPage
        ], Response::HTTP_OK);
    }
}
