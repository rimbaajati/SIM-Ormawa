<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * 1. REGISTER (Daftar Akun Baru)
     */
    public function register(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            // Kita batasi role apa saja yang boleh didaftarkan
            'role'     => 'required|in:user,admin,manager', 
        ]);

        // Buat user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Opsional: Langsung login setelah daftar (buat token)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user'    => $user,
            'token'   => $token
        ], 201);
    }

    /**
     * 2. LOGIN (Masuk)
     */
    public function login(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login dengan Auth::attempt (otomatis cek hash password)
        if (!Auth::attempt($request->only('email', 'password'))) {
            // Jika gagal, lempar error validasi standar Laravel
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Jika berhasil, ambil data user
        $user = User::where('email', $request->email)->firstOrFail();

        // Buat token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user'    => $user,
            'token'   => $token,
        ]);
    }

    /**
     * 3. LOGOUT (Keluar)
     */
    public function logout(Request $request): JsonResponse
    {
        // Hapus token yang sedang digunakan saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil logout'
        ]);
    }

    /**
     * 4. GET USER (Ambil Data Profil User yang Sedang Login)
     * Method ini diperlukan untuk route '/user'
     */
    public function user(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}