<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('v1/warehouses', \App\Http\Controllers\Api\V1\WarehouseController::class);
Route::get('v1/warehouses/{id}/sections', [\App\Http\Controllers\Api\V1\WarehouseSectionsController::class, 'index']);
Route::apiResource('v1/sections', \App\Http\Controllers\Api\V1\SectionLocationController::class);
Route::get('v1/sections/{id}/corridors', [\App\Http\Controllers\Api\V1\SectionCorridorsController::class, 'index']);
Route::apiResource('v1/corridors', \App\Http\Controllers\Api\V1\CorridorController::class);
Route::get('v1/corridors/{id}/racks', [\App\Http\Controllers\Api\V1\CorridorRacksController::class, 'index']);
Route::apiResource('v1/racks', \App\Http\Controllers\Api\V1\RackController::class);
Route::get('v1/racks/{id}/levels', [\App\Http\Controllers\Api\V1\RackLevelsController::class, 'index']);
Route::apiResource('v1/levels', \App\Http\Controllers\Api\V1\LevelController::class);
Route::get('v1/levels/{id}/positions', [\App\Http\Controllers\Api\V1\LevelPositionsController::class, 'index']);
Route::apiResource('v1/positions', \App\Http\Controllers\Api\V1\PositionController::class);
Route::get('v1/positions/{id}/bins', [\App\Http\Controllers\Api\V1\PositionBinsController::class, 'index']);
Route::apiResource('v1/bins', \App\Http\Controllers\Api\V1\BinController::class);

