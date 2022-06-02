<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TailorRegistrationController;

/*
|----------------------------------/----------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     Route::prefix('admin')->group(function () {
//         Route::post('register', 'AdminController@store');
//         //Route::post('search-approver-data', 'API\EmployeeLeaveRequestController@searchApproverData');
//     });
//     return $request->user();
// });
Route::post('admin-register',[AdminController::class, 'store']);
Route::post('register-tailor',[TailorRegistrationController::class, 'store']);
Route::get('search-tailor',[TailorRegistrationController::class, 'index']);
Route::post('delete-tailor',[TailorRegistrationController::class, 'destroy']);
Route::get('edit-tailor/{id}',[TailorRegistrationController::class, 'show']);
Route::put('update-tailor/{id}',[TailorRegistrationController::class, 'update']);
