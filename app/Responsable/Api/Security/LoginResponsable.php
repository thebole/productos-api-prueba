<?php

namespace App\Responsable\Api\Security;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;

class LoginResponsable implements Responsable
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function toResponse($request)
    {

        if(isset(Auth::user()->id)) {
            return response()->json([
                'message' => 'Login successful',
            ], 200);
        }

        return response()->json([
            'message' => 'Login failed',
        ], 401);
    }
}
