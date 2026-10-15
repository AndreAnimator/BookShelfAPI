<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());

        return response()->json([
            'user'       => new UserResource($result['user']),
            'token'      => $result['token'],
            'token_type' => 'Bearer',
            'expires_at' => $result['expires_at'],
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        return response()->json([
            'user'       => new UserResource($result['user']),
            'token'      => $result['token'],
            'token_type' => 'Bearer',
            'expires_at' => $result['expires_at'],
        ]);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->noContent();
    }

    public function logoutAll(Request $request)
    {
        $this->authService->logoutFromAllDevices($request->user());

        return response()->noContent();
    }
}