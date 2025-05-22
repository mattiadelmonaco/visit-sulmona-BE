<?php

use App\Http\Controllers\Api\PoiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get("/poi", [PoiController::class, "index"]);

Route::get("/poi/{poi}", [PoiController::class, "show"]);

Route::get("/poi/type/{typeId}", [PoiController::class, "indexByType"]);

Route::get("/types", [PoiController::class, "indexTypes"]);

Route::get('/poi/macro-category/{macroCategory}', [PoiController::class, 'indexByMacroCategory']);