<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Responsable\Api\Security\AuthResponsable;
use App\Responsable\Api\Security\LoginResponsable;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function index(LoginResponsable $response)
    {
        return $response;
    }


    public function login(Request $request, AuthResponsable $response)
    {
        return $response->toResponse($request);
    }
}
