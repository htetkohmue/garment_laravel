<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Raw\RawMaterialController;
use App\Http\Controllers\API\Tailor\TailorListController;
use App\Http\Controllers\API\Tailor\TailorRegistrationController;
use App\Http\Controllers\API\Supplier\SupplierController;
use Illuminate\Http\Response;
use App\Http\Controllers\API\Product\ProductListController;
use App\Http\Controllers\API\Township\TownshipController;
use App\Http\Controllers\API\Customer\CustomerController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('tailor-list')->group(function () {
    Route::get('search-tailor',[TailorListController::class, 'search']);
    Route::post('delete-tailor',[TailorListController::class, 'destroy']);
});
Route::prefix('tailor-register')->group(function () {
    Route::post('register-tailor',[TailorRegistrationController::class, 'store']);
    Route::get('edit-tailor/{id}',[TailorRegistrationController::class, 'show']);
    Route::put('update-tailor/{id}',[TailorRegistrationController::class, 'update']);
});
Route::prefix('product-in-list')->group(function () {
    Route::get('searchTailor',[ProductListController::class, 'searchTailor']);
    Route::get('searchTailorByID',[ProductListController::class, 'searchTailorByID']);
    Route::post('search-product',[ProductListController::class, 'search']);
});

Route::prefix('raws')->group(function () {
    Route::post('raw-register',[RawMaterialController::class, 'store']);
    Route::get('raw-search',[RawMaterialController::class, 'index']);
    Route::post('raw-delete',[RawMaterialController::class, 'destroy']);
    Route::post('raw-edit/{id}',[RawMaterialController::class, 'show']);
    Route::put('raw-update/{id}',[RawMaterialController::class, 'update']);
});

Route::prefix('supplier')->group(function () {
    Route::post('create',[SupplierController::class, 'saveSupplier']);
    Route::get('retrieve',[SupplierController::class, 'getSupplierList']);
    Route::post('update',[SupplierController::class, 'editSupplier']);
    Route::post('delete',[SupplierController::class, 'removeSupplier']);
});

Route::prefix('customer')->group(function () {
    Route::post('storeCustomer',[CustomerController::class, 'store']);
    Route::get('getCustomerList',[CustomerController::class, 'show']);
    Route::get('editCustomer/{id}',[CustomerController::class, 'edit']);
    Route::post('updateCustomer',[CustomerController::class, 'update']);
    Route::post('deleteCustomer',[CustomerController::class, 'destroy']);
    Route::get('getCustomerId',[CustomerController::class, 'getCustomerId']);
    // Route::get('getAllCustomerId',[CustomerController::class, 'getAllCustomerId']);
});

Route::prefix('township')->group(function () {
    Route::get('getTownship',[TownshipController::class, 'index']);
    Route::post('storeTownship',[TownshipController::class, 'store']);
});




