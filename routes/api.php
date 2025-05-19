<?php

use App\Http\Controllers\Api\PoiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get("/poi", [PoiController::class, "index"]);

Route::get("/poi/{poi}", [PoiController::class, "show"]);

