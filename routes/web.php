<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;


use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderItemController;
use App\Models\User;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SearchController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::apiResource('art', ArtController::class);
// Route::get('/art',"ArtController@index");
// Route::get('/art', [ArtController::class, 'index']);
// Route::get('/art/{id}', [ArtController::class, 'showOne']);
// Route::post('/art', [ArtController::class, 'store']);
// Route::put('/art/{id}', [ArtController::class, 'update']);
// Route::delete('/art/{id}', [ArtController::class, 'destroy']);

// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/{id}', [UserController::class, 'showOne']);
// // Route::get('/users/csrf', [UserController::class, 'getCsrfToken']);
// Route::post('/users', [UserController::class, 'store']);
// Route::put('/users/{id}', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy']);
// Route::apiResource('users', UserController::class);
// Route::apiResource('categories', CategoryController::class);
// Route::apiResource('products', ProductController::class);

// Route::apiResource('orders', OrderController::class);
// Route::apiResource('customers', CustomerController::class);
// Route::post('products/search',[ProductController::class,'searchByName']);
// Route::middleware(['auth:sanctum', 'admin'])->group(function () {




// });
//  Route::post('products/search', [ProductController::class,'searchByName']);
// Route::get('/search', 'SearchController@search');
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Route::apiResource('users', UserController::class);
    // Route::apiResource('categories', CategoryController::class);
    // Route::apiResource('products', ProductController::class);

    // Route::apiResource('orders', OrderController::class);
    // Route::apiResource('customers', CustomerController::class);
    // Route::post('products/search',[ProductController::class,'searchByName']);
    // Route::get('products/search', [ProductController::class,'searchByName']);

    Route::post('search', [SearchController::class,'search']);


});
Route::post('/register', [AuthController::class, 'register']);

