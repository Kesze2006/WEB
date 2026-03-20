<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

Route::get("/", function () {
    return view("welcome");
});

// Email verification notice
Route::get("/email/verify", function () {
    return view("auth.verify-email"); // Breeze tartalmazza ezt a view-t
})
    ->middleware("auth")
    ->name("verification.notice");

// Email verification link
Route::get("/email/verify/{id}/{hash}", function (EmailVerificationRequest $request) {
    $request->fulfill(); // email verifikálása
    return redirect("/dashboard");
})
    ->middleware(["auth", "signed"])
    ->name("verification.verify");

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
});

require __DIR__ . "/auth.php";
