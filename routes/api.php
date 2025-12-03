<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }

    return response()->json([
        'message' => 'Invalid credentials'
    ], 401);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('batiments', \App\Http\Controllers\API\BatimentController::class);
    Route::apiResource('appartements', \App\Http\Controllers\API\AppartementController::class);
    Route::apiResource('etudiants', \App\Http\Controllers\API\EtudiantController::class);
    Route::apiResource('dossiers-candidature', \App\Http\Controllers\API\DossierCandidatureController::class);
});