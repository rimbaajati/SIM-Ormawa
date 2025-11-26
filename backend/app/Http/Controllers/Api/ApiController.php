<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ApiController extends Controller
{
    public function register(Request $request)
    {
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => ['required', 'confirmed', Password::min(6)
               ->mixedCase()
               ->letters()
               ->numbers()
               ->symbols()
               ->uncompromised()],
            'role' => 'required|string|in:manager,admin,user',
       ]);
        $user = User::create([
           'name' => $validated['name'],
           'email' => $validated['email'],
           'password' => Hash::make($validated['password']),
        ]);

        //PIlih Role Jon!!!
        $user->assignRole($validated['role']);

        return response()->json([
          'status' => true,
          'message' => 'User registered successfully',
          'user'=>$user
        ], 201);
    }

    public function login(Request $request)
    {
       $credentials = $request->only('email', 'password');

       if (!Auth::attempt($credentials)) {
           return response()->json([
               'status' => false,
               'message' => 'Invalid credentials'
           ], 401);
       }
        $user = Auth::user();
        $token = JWTAuth::fromUser($user);

        return response()->json([
           'status' => true,
           'message' => 'Login successful',
           'token' => $token,
           'user' => $user
        ], 200);
    }

    public function logout(Request $request)
    {
       $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }
}