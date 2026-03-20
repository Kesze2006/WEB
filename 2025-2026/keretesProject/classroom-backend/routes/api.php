<?php

use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::post("/register", [AuthController::class, "register"]);

Route::get("/email", function () {
    Mail::raw("Ez egy teszt email", function ($message) {
        $message->to("keszericze.akso.21@ady-nagyatad.hu")->subject("Teszt");
    });
});
