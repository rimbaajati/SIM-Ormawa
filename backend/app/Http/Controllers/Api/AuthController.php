<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        $req->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
        ]);

        // kalau pakai sanctum token
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message'=>'User terdaftar',
            'user'=>$user,
            'token'=>$token
        ], 201);
    }

    public function login(Request $req)
    {
        $req->validate(['email'=>'required','password'=>'required']);

        $user = User::where('email', $req->email)->first();
        if (!$user || !Hash::check($req->password, $user->password)) {
            throw ValidationException::withMessages([
               'email' => ['Email atau password salah']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token'=>$token, 'user'=>$user]);
    }
}
