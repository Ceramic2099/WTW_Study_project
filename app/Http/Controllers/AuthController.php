<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function register(UserRequest $request)
    {
        $params = $request->safe()->except('file');
        $user = User::create($params);
        $token = $user->createToken('auth-token');

        if(!$user) {
            return $this->fail([
                'error' => $user
            ]);
        }

        return $this->success([
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }




public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated())) {
            abort(401, trans('auth.failed'));
        }

        $token = Auth::user()->createToken('auth-token');

        return $this->success(['token' => $token->plainTextToken]);
    }

public function logout()
    {
        Auth::user()->tokens()->delete();

        return $this->success(null, 204);
    }
}
