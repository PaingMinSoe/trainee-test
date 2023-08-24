<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('trainee_test')->accessToken;

        return response()->json([
            'message' => 'Registration Successful',
            'user' => $user,
            'access_token' => $token,
        ], 201);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('trainee_test')->accessToken;

            return response()->json([
                'message' => 'Login Successful',
                'user' => $user,
                'access_token' => $token,
            ]);
        } else {
            return response()->json([
                'message' => 'Incorrect Credentials'
            ],401);
        }


    }

    public function logout() {
        Auth::user()->token()->revoke();

        return response()->json([
            'message' => 'Logout Successful',
        ]);
    }
}

