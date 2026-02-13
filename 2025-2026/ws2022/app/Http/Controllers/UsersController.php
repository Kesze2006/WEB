<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function Adminer\view;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return \view("users", compact("users"));
    }

    public function show($username)
    {
        $user = User::where("username", $username)->firstOrFail();

        return \view("user",compact("user"));
    }
}
