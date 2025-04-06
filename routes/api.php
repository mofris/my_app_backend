<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/contact', [ContactController::class, 'contact']);
Route::post('/contact/created', [ContactController::class, 'store']);
Route::put('/contact/update/{id}', [ContactController::class, 'update']);
Route::delete('/contact/{id}', [ContactController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
