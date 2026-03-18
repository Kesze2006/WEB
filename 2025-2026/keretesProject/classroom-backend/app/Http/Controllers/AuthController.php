<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ----- REGISZTRÁCIÓ -----
    public function register(Request $request)
    {
        // 1. Validáció
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required",
        ]);

        // 2. User létrehozása
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => "diak", // alapértelmezett szerep
        ]);

        // 3. Token generálás
        $token = $user->createToken("api-token")->plainTextToken;

        // 4. JSON válasz
        return response()->json([
            "user" => $user,
            "token" => $token,
        ]);
    }

    // ----- LOGIN -----
    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");

        if (!Auth::attempt($credentials)) {
            return response()->json(
                [
                    "message" => "Hibás email vagy jelszó",
                ],
                401,
            );
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken("api-token")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token,
        ]);
    }

    // ----- LOGOUT -----
    public function logout(Request $request)
    {
        // az aktuális token törlése
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "Sikeres kijelentkezés",
        ]);
    }

    // ----- USER INFO -----
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
