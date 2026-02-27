<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Responsable\Api\Product\AllProductResponsable;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index(AllProductResponsable $response)
    {
        return $response;
    }
}
