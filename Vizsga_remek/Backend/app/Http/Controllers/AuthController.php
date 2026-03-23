<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*Regisztráció*/

    public function registration(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "password" => "required|string|min:10|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",  //regex:/[@$!%*#?&]/ -speciális karakterek"
            "email" => "required|email|unique:users,email",
            "role" => "required|int"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role_id" => $request->role
        ]);

        event(new Registered($user));
        $user->sendEmailVerificationNotification();

        $token = $user->createToken("api-token")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token,
        ]);
    }
}
