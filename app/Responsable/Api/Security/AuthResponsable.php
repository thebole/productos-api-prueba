<?php

namespace App\Responsable\Api\Security;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;

class AuthResponsable implements Responsable
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
        $credentials = $request->validate([
            'email_username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);


        $user = $this->login($credentials['email_username'], $credentials['password']);
        return $user;
    }

    private function login(string $username, string $password)
    {
        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::attempt([$field => $username, 'password' => $password])) {
            return response()->json([
                'message' => 'Login failed',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user->name,
            'token' => $token,
            'roles' => $user->getRoleNames()->values(),
            'permissions' => $user->getAllPermissions()->pluck('name')->values(),
            'message' => 'Login successful',
        ], 200);
    }
}
