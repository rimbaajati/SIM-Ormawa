<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register (optional, bisa di-skip dulu)
    public function register(Request $request)
    {
=======
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use validator;

class AuthController extends Controller
{
    // --- 1. REGISTER (Daftar Akun Baru) ---
    public function register(Request $request): JsonResponse
    {
        // Validasi input dari frontend
>>>>>>> 9737a2584fa7e057de3d4e009e8dd97b7d41d5bc
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin,manager',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
<<<<<<< HEAD
            'role' => $request->role,
=======
            // Default role, jika tabel user Anda punya kolom 'role'
            // 'role' => 'ormawa' 
>>>>>>> 9737a2584fa7e057de3d4e009e8dd97b7d41d5bc
        ]);

        return response()->json(['message' => 'User registered', 'user' => $user], 201);
    }
    // public function register(Request $request): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //     ]);
   
    //     if($validator->fails()){
    //         return $this->sendError('Validation Error.', $validator->errors());       
    //     }
   
    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);
    //     $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //     $success['name'] =  $user->name;
   
    //     return $this->sendResponse($success, 'User register successfully.');
    // }

<<<<<<< HEAD
    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
=======
    // --- 2. LOGIN (Masuk) ---
    public function login(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
>>>>>>> 9737a2584fa7e057de3d4e009e8dd97b7d41d5bc
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

<<<<<<< HEAD
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
=======
        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada DAN password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Jika salah, kirim error validasi
            throw ValidationException::withMessages([
               'email' => ['Email atau password yang Anda masukkan salah.']
            ]);
>>>>>>> 9737a2584fa7e057de3d4e009e8dd97b7d41d5bc
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
