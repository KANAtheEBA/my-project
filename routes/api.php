<?php

use App\Http\Controllers\SteamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/steam/games/search', [SteamController::class, 'search']);
