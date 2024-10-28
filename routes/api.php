<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
 
Route::post('/car', [CarController::class, 'Car']);

Route::get('/car_info', [CarController::class, 'getCarInfo']);

Route::get('/car_info/{id}',[CarController::class,'SingleCarInfo']);

Route::post('/car_info/{id}',[CarController::class,'UpdateCarInfo']);

Route::post('/user_create', [UserController::class, 'CreateUser']);
Route::get('/user', [UserController::class, 'GetAllUser']);
Route::get('/user/{user_id}', [UserController::class, 'GetSingleUser']);

Route::post('/category_create', [CategoryController::class, 'CreateCategory']);
Route::get('/category', [CategoryController::class, 'GetAllCategory']); 
Route::get('/category/{category_id}', [CategoryController::class, 'GetSingleCategory']);

Route::post('/product_create', [ProductController::class, 'CreateProduct']); 
Route::get('/product', [ProductController::class, 'GetAllProduct']); 
Route::get('/product/{product_id}', [ProductController::class, 'GetSingleProduct']); 
