<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        // $data['password'] = Hash::make($request->password);
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        $token = $user->createToken($request->name)->plainTextToken;

        // return (new UserResource($user))->additional(['token' => $token]);
        return ApiResponse::message(1, new UserResource($user, $token), 'user has been registered successfully');
    }
}
