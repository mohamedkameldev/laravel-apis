<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function login(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        $validator = validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return ApiResponse::message(0, $validator->errors(), $validator->errors()->first());
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken($user->name)->plainTextToken;
            return ApiResponse::message(1, new UserResource($user, $token), 'user logged in successfully');
        }
        return ApiResponse::message(0, message: 'there are some errors has been occured');
    }
}
