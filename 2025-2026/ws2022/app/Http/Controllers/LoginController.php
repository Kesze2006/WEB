<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("login");
    }

    public function login(Request $request)
    {
        $request->validate([
            "username" => "required|exists:admins,username",
            "password" => "required",
        ]);

        $credentials = $request->only("username", "password");

        if (Auth::guard("admin")->attempt($credentials)) {
            /**  @var Admin $admin */
            $admin = Auth::guard("admin")->user();
            $admin->update([
                "last_login_at" => now(),
            ]);
            return redirect("admins");
        }

        return back()->withErrors([
            "error" => "The provided credentials do not match our records.",
        ]);
    }
}
