<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderItemController;
use App\Models\User;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SearchController;
// use App\Http\Controllers\EmailVerificationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User registration
// Route::post('/register', [AuthController::class, 'register']);

// User login
Route::post('/login', [AuthController::class, 'login']);

// User logout (requires authentication)
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// routes/web.php
//



Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
//  Route::get('/search', [SearchController::class,'search']);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('customers', CustomerController::class);
    // Route::post('products/search',[ProductController::class,'searchByName']);
    // Route::get('products/search', [ProductController::class,'searchByName']);



});
// Route::get('/search', 'SearchController@search');

