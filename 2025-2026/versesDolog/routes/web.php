<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KoltoController;
use App\Http\Controllers\VersekController;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/welcome", function () {
    return view("foOldal");
});

Route::get("/koltok", [KoltoController::class, "index"]);

Route::get("/versek", [VersekController::class, "index"]);
