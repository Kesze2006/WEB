<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
Route::get("/", function () {
    return view("welcome");
});
*/

Route::redirect("/", "/login");
Route::get("/login", [LoginController::class, "showLoginForm"]);
Route::post("/login", [LoginController::class, "login"]);
