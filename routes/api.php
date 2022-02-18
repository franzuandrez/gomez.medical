<?php


use App\Http\Controllers\Api\v1\AddressTypeController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BankController;
use App\Http\Controllers\Api\v1\BinController;
use App\Http\Controllers\Api\v1\BrandController;
use App\Http\Controllers\Api\v1\BusinessEntityAddBankAccountController;
use App\Http\Controllers\Api\v1\BusinessEntityAddressController;
use App\Http\Controllers\Api\v1\CategorySubcategoriesController;
use App\Http\Controllers\Api\v1\ControlCashRegisterController;
use App\Http\Controllers\Api\v1\CorridorController;
use App\Http\Controllers\Api\v1\CorridorRacksController;
use App\Http\Controllers\Api\v1\CustomerController;
use App\Http\Controllers\Api\v1\CustomerGetDefaultController;
use App\Http\Controllers\Api\v1\DashboardController;
use App\Http\Controllers\Api\v1\EmployeeController;
use App\Http\Controllers\Api\v1\InventoryController;
use App\Http\Controllers\Api\v1\InventoryManagementController;
use App\Http\Controllers\Api\v1\InventoryPrintoutController;
use App\Http\Controllers\Api\v1\LabelTypeController;
use App\Http\Controllers\Api\v1\LevelController;
use App\Http\Controllers\Api\v1\LevelPositionsController;
use App\Http\Controllers\Api\v1\ListCostHistoryController;
use App\Http\Controllers\Api\v1\ListPriceHistoryController;
use App\Http\Controllers\Api\v1\PaymentController;
use App\Http\Controllers\Api\v1\PaymentTypeController;
use App\Http\Controllers\Api\v1\PersonController;
use App\Http\Controllers\Api\v1\PhoneNumberController;
use App\Http\Controllers\Api\v1\PhoneNumberTypeController;
use App\Http\Controllers\Api\v1\PositionBinsController;
use App\Http\Controllers\Api\v1\PositionController;
use App\Http\Controllers\Api\v1\PrintoutController;
use App\Http\Controllers\Api\v1\ProductCategoryController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProductImageController;
use App\Http\Controllers\Api\v1\ProductSubCategoryController;
use App\Http\Controllers\Api\v1\PurchaseController;
use App\Http\Controllers\Api\v1\PurchaseEditProductController;
use App\Http\Controllers\Api\v1\PurchaseHeaderDetailController;
use App\Http\Controllers\Api\v1\PurchaseHeaderFinishPriceEditionController;
use App\Http\Controllers\Api\v1\PurchaseLocateProductsController;
use App\Http\Controllers\Api\v1\PurchasePaymentController;
use App\Http\Controllers\Api\v1\RackController;
use App\Http\Controllers\Api\v1\RackLevelsController;
use App\Http\Controllers\Api\v1\SalesController;
use App\Http\Controllers\Api\v1\SectionCorridorsController;
use App\Http\Controllers\Api\v1\SectionLocationController;
use App\Http\Controllers\Api\v1\ShipMethodController;
use App\Http\Controllers\Api\v1\StockByTypeController;
use App\Http\Controllers\Api\v1\StockController;
use App\Http\Controllers\Api\v1\UnitMeasureController;
use App\Http\Controllers\Api\v1\UnPaidSalesController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\VendorController;
use App\Http\Controllers\Api\v1\VendorProductsController;
use App\Http\Controllers\Api\v1\WarehouseController;
use App\Http\Controllers\Api\v1\WarehouseSectionsController;
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


Route::post('v1/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/logout', [AuthController::class, 'logout']);
    Route::get('v1/user', [AuthController::class, 'show']);
    Route::apiResource('v1/warehouses', WarehouseController::class);
    Route::get('v1/warehouses/{id}/sections', [WarehouseSectionsController::class, 'index']);
    Route::apiResource('v1/sections', SectionLocationController::class);
    Route::get('v1/sections/{id}/corridors', [SectionCorridorsController::class, 'index']);
    Route::apiResource('v1/corridors', CorridorController::class);
    Route::get('v1/corridors/{id}/racks', [CorridorRacksController::class, 'index']);
    Route::apiResource('v1/racks', RackController::class);
    Route::get('v1/racks/{id}/levels', [RackLevelsController::class, 'index']);
    Route::apiResource('v1/levels', LevelController::class);
    Route::get('v1/levels/{id}/positions', [LevelPositionsController::class, 'index']);
    Route::apiResource('v1/positions', PositionController::class);
    Route::get('v1/positions/{id}/bins', [PositionBinsController::class, 'index']);
    Route::apiResource('v1/bins', BinController::class);
    Route::apiResource('v1/vendors', VendorController::class);
    Route::apiResource('v1/addresses_type', AddressTypeController::class);
    Route::apiResource('v1/categories', ProductCategoryController::class);
    Route::get('v1/categories/{id}/subcategories', [CategorySubcategoriesController::class, 'index']);
    Route::apiResource('v1/subcategories', ProductSubCategoryController::class);
    Route::post('v1/business_entity_addresses', [BusinessEntityAddressController::class, 'store']);
    Route::get('v1/products', [ProductController::class, 'index']);
    Route::post('v1/products', [ProductController::class, 'store']);
    Route::get('v1/products/{id}', [ProductController::class, 'show']);
    Route::patch('v1/products/{id}', [ProductController::class, 'update']);

    Route::get('v1/vendors/{vendor_id}/products', [VendorProductsController::class, 'index']);
    Route::post('v1/vendors/{vendor_id}/products/{product_id}', [VendorProductsController::class, 'store']);
    Route::patch('v1/vendors/{vendor_id}/products/{product_id}', [VendorProductsController::class, 'update']);
    Route::delete('v1/vendors/{vendor_id}/products/{product_id}', [VendorProductsController::class, 'destroy']);
    Route::get('v1/customers', [CustomerController::class, 'index']);
    Route::post('v1/customers', [CustomerController::class, 'store']);
    Route::get('v1/customers/{id}', [CustomerController::class, 'show']);
    Route::get('v1/phone_number_types', [PhoneNumberTypeController::class, 'index']);
    Route::post('v1/phone_number', [PhoneNumberController::class, 'store']);
    Route::apiResource('v1/ship_methods', ShipMethodController::class);


    Route::get('v1/stocks', [StockController::class, 'index']);
    Route::get('v1/stocks/{id}', [StockController::class, 'show']);
    Route::post('v1/inventory', [InventoryController::class, 'store']);
    Route::get('v1/sales', [SalesController::class, 'index']);
    Route::post('v1/sales', [SalesController::class, 'store']);
    Route::patch('v1/unpaid_sales/{id}', [UnPaidSalesController::class, 'update']);
    Route::get('v1/sales/{id}', [SalesController::class, 'show']);
    Route::apiResource('v1/employees', EmployeeController::class);
    Route::apiResource('v1/employees_user', UserController::class);
    Route::get('v1/dashboard', [DashboardController::class, 'index']);
    Route::patch('v1/purchases_locate_products/{id}', [PurchaseLocateProductsController::class, 'update']);
    Route::get('v1/inventory_management/{id}', [InventoryManagementController::class, 'show']);
    Route::post('v1/inventory_management', [InventoryManagementController::class, 'store']);
    Route::get('v1/inventory_management', [InventoryManagementController::class, 'index']);
    Route::get('v1/stock_by_type', [StockByTypeController::class, 'index']);
    Route::get('v1/banks', [BankController::class, 'index']);
    Route::post('v1/business_entity_banks', [BusinessEntityAddBankAccountController::class, 'store']);
    Route::post('v1/control_cash_register', [ControlCashRegisterController::class, 'store']);
    Route::patch('v1/control_cash_register/{id}', [ControlCashRegisterController::class, 'update']);
    Route::post('v1/payments', [PaymentController::class, 'store']);
    Route::patch('v1/purchase_product_price/{id}', [PurchaseEditProductController::class, 'update']);
    Route::patch('v1/purchase_header_finish_price_edition/{id}', [PurchaseHeaderFinishPriceEditionController::class, 'update']);
    Route::post('v1/purchase/make_payment', [PurchasePaymentController::class, 'store']);
});
Route::get('v1/purchases/{id}/payments', [PurchasePaymentController::class, 'index']);
Route::get('v1/default_customer', [CustomerGetDefaultController::class, 'index']);

Route::get('v1/payments', [PaymentController::class, 'index']);
Route::get('v1/payment_types', [PaymentTypeController::class, 'index']);
Route::get('v1/control_cash_register', [ControlCashRegisterController::class, 'index']);
Route::get('v1/control_cash_register/{id}', [ControlCashRegisterController::class, 'show']);
Route::get('v1/labels_types', [LabelTypeController::class, 'index']);
Route::get('v1/inventory_printouts', [InventoryPrintoutController::class, 'index']);
Route::get('v1/pending_printouts/{id}', [PrintoutController::class, 'show']);
Route::post('v1/pending_printouts', [PrintoutController::class, 'store']);
Route::apiResource('v1/purchases', PurchaseController::class);
Route::apiResource('v1/purchases_detail', PurchaseHeaderDetailController::class);
Route::get('v1/people', [PersonController::class, 'index']);
Route::get('v1/brands', [BrandController::class, 'index']);
Route::post('v1/brands', [BrandController::class, 'store']);
Route::get('v1/brands/{id}', [BrandController::class, 'show']);
Route::patch('v1/brands/{id}', [BrandController::class, 'update']);
Route::get('v1/unit_measures', [UnitMeasureController::class, 'index']);

Route::post('v1/product/image', [ProductImageController::class, 'store']);
Route::delete('v1/product/image/{id}', [ProductImageController::class, 'destroy']);
Route::delete('v1/product/images/{id}', [ProductImageController::class, 'destroy_many']);
Route::get('v1/price/history/{id}', [ListPriceHistoryController::class, 'index']);
Route::get('v1/cost/history/{id}', [ListCostHistoryController::class, 'index']);
