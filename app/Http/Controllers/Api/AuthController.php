<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {

        $request->authenticate();

        $user = $request->user();

        $token = $user->createToken('token-name')->plainTextToken;

        return response([
            'user' => new UserResource($user),
            'token' => $token
        ], 201);
    }

    public function logout(Request $request)
    {
        // https://laravel.com/docs/8.x/queries#delete-statements
        $request->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
