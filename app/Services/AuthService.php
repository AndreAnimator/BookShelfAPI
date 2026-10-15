<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create($data);
        $token = $this->issueToken($user);

        return [
            'user'  => $user,
            'token' => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at,
        ];
    }

    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        // one single message for "no such user" and "wrong password" on purpose
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        $token = $this->issueToken($user);

        return [
            'user'  => $user,
            'token' => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at,
        ];
    }

    private function issueToken(User $user): NewAccessToken
    {
        $minutes = config('sanctum.expiration');

        // null expiration means "no clock at all" — keep the column null in that case
        return $user->createToken(
            'api-token',
            ['*'],
            $minutes ? now()->addMinutes($minutes) : null,
        );
    }

    public function logout(User $user): void
    {
        // revokes only the token used in the current request
        $user->currentAccessToken()->delete();
    }

    public function logoutFromAllDevices(User $user): void
    {
        // revokes every token this user owns
        $user->tokens()->delete();
    }
}