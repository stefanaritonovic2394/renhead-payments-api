<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user with the token
     *
     * @param RegisterRequest $request
     * @return AuthResource
     */
    public function register(RegisterRequest $request): AuthResource
    {
        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('grantapitoken')->plainTextToken;

        return new AuthResource([
            'token' => $token,
            'user' => $user
        ]);
    }

    /**
     * Login the current user
     *
     * @param LoginRequest $request
     * @return AuthResource|array
     */
    public function login(LoginRequest $request): AuthResource|array
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ['message' => 'Bad credentials'];
        }

        $token = $user->createToken('grantapitoken')->plainTextToken;

        return new AuthResource([
            'token' => $token,
            'user' => $user
        ]);
    }

    /**
     * Logout the user
     *
     * @return array
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return ['message' => 'Logged out successfully'];
    }
}
