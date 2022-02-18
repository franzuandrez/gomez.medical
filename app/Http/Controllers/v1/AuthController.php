<?php

namespace App\Http\Controllers\v1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\v2\UserResource;

class AuthController extends Controller
{
    //


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response([
                'code' => 'auth/user-not-found',
                'message' => 'User not found',
            ], 500);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response([
                'code' => 'auth/wrong-password',
                'message' => 'Incorrecct password',
            ], 500);
        }

        return response([
            'token' => $user->createToken('accessToken')->plainTextToken
        ]);


    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response([
            ''
        ], 201);

    }

    public function show(Request $request)
    {


        return new UserResource($request->user());

    }
}
