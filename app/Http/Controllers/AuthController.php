<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTrait;

    public function login(LoginRequest $request)
    {
        $input = $request->validated();

        $user = User::where('email', $input['email'])->first();

        if (! $user || ! Hash::check($input['password'], $user->password)) {
            $output = [
                'success' => false,
                'message' => __('messages.user.wrong_username_or_password'),
                'data' => [],
            ];

            return $this->showResponse($output, 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        $output = [
            'success' => true,
            'message' => __('messages.public.success'),
            'data' => [
                'token' => $token,
                'user' => $user->only(['id', 'name', 'email']),
            ],
        ];

        return $this->showResponse($output);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        $output = [
            'success' => true,
            'message' => __('messages.public.success'),
            'data' => [],
        ];

        return $this->showResponse($output);
    }
}
