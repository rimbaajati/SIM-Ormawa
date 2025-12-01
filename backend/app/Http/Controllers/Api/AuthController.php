<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Buat user baru di database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Default role, jika tabel user Anda punya kolom 'role'
            // 'role' => 'ormawa' 
        ]);

        // Buat token agar user langsung login setelah daftar
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'User berhasil didaftarkan',
            'user' => $user,
            'token' => $token
        ], 201);
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

    // --- 2. LOGIN (Masuk) ---
    public function login(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada DAN password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Jika salah, kirim error validasi
            throw ValidationException::withMessages([
               'email' => ['Email atau password yang Anda masukkan salah.']
            ]);
        }

        // Jika benar, buat token baru
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token, // Token ini disimpan di Frontend (localStorage/Cookie)
            'user' => $user
        ]);
    }

    // --- 3. LOGOUT (Keluar) ---
    public function logout(Request $req)
    {
        // Hapus token yang sedang digunakan user saat ini
        // (Token lain di perangkat lain tetap aman)
        $req->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil logout'
        ]);
    }

    // --- 4. USER (Cek Data Diri) ---
    public function user(Request $req)
    {
        // Mengembalikan data user yang sedang login
        // Laravel otomatis tahu user siapa berdasarkan token
        return response()->json($req->user());
    }
}