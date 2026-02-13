<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Models\Admin;

/*
Route::get("/", function () {
    return view("welcome");
});
*/

Route::redirect("/", "/login");
Route::get("/login", [LoginController::class, "showLoginForm"]);
Route::post("/login", [LoginController::class, "login"]);

Route::get("/admins",[AdminController::class, "index"]);
Route::get("/users",[UsersController::class, "index"]);
Route::get("/users/{username}",[UsersController::class, "show"]);
