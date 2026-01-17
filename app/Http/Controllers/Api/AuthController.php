<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponseHelper::success(
            __('message.USER_REGISTERED'), 
            'data', 
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        );
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return ApiResponseHelper::error(__('message.INVALID_LOGIN'), 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return ApiResponseHelper::success(
            __('message.LOGIN_SUCCESS'), 
            'data', 
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return ApiResponseHelper::success(__('message.LOGOUT_SUCCESS'), 'data', []);
    }
}

