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
Route::apiResource('v1/vendors', \App\Http\Controllers\Api\V1\VendorController::class);
Route::apiResource('v1/addresses_type', \App\Http\Controllers\Api\V1\AddressTypeController::class);
Route::apiResource('v1/categories', \App\Http\Controllers\Api\V1\ProductCategoryController::class);
Route::get('v1/categories/{id}/subcategories', [\App\Http\Controllers\Api\V1\CategorySubcategoriesController::class, 'index']);
Route::apiResource('v1/subcategories', \App\Http\Controllers\Api\V1\ProductSubCategoryController::class);
Route::post('v1/business_entity_addresses', [\App\Http\Controllers\Api\V1\BusinessEntityAddressController::class, 'store']);
Route::get('v1/products', [\App\Http\Controllers\Api\V1\ProductController::class, 'index']);
Route::post('v1/products', [\App\Http\Controllers\Api\V1\ProductController::class, 'store']);
Route::get('v1/products/{id}', [\App\Http\Controllers\Api\V1\ProductController::class, 'show']);
Route::patch('v1/products/{id}', [\App\Http\Controllers\Api\V1\ProductController::class, 'update']);
Route::get('v1/vendors/{vendor_id}/products', [\App\Http\Controllers\Api\V1\VendorProductsController::class, 'index']);
Route::post('v1/vendors/{vendor_id}/products/{product_id}', [\App\Http\Controllers\Api\V1\VendorProductsController::class, 'store']);
Route::patch('v1/vendors/{vendor_id}/products/{product_id}', [\App\Http\Controllers\Api\V1\VendorProductsController::class, 'update']);
Route::delete('v1/vendors/{vendor_id}/products/{product_id}', [\App\Http\Controllers\Api\V1\VendorProductsController::class, 'destroy']);
Route::get('v1/customers', [\App\Http\Controllers\Api\V1\CustomerController::class, 'index']);
Route::post('v1/customers', [\App\Http\Controllers\Api\V1\CustomerController::class, 'store']);
Route::get('v1/customers/{id}', [\App\Http\Controllers\Api\V1\CustomerController::class, 'show']);
Route::get('v1/phone_number_types', [\App\Http\Controllers\Api\V1\PhoneNumberTypeController::class, 'index']);
Route::post('v1/phone_number', [\App\Http\Controllers\Api\V1\PhoneNumberController::class, 'store']);
Route::apiResource('v1/ship_methods', \App\Http\Controllers\Api\V1\ShipMethodController::class);
Route::apiResource('v1/purchases', \App\Http\Controllers\Api\V1\PurchaseController::class);
Route::get('v1/stocks', [\App\Http\Controllers\Api\V1\StockController::class, 'index']);
Route::post('v1/inventory', [\App\Http\Controllers\Api\V1\InventoryController::class, 'store']);
Route::get('v1/sales', [\App\Http\Controllers\Api\V1\SalesController::class, 'index']);
Route::post('v1/sales', [\App\Http\Controllers\Api\V1\SalesController::class, 'store']);
Route::get('v1/sales/{id}', [\App\Http\Controllers\Api\V1\SalesController::class, 'show']);



