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


Route::middleware(['auth:sanctum','customer'])->post('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/admin-login', [AuthController::class, 'adminLogin']);

 Route::post('/register', [AuthController::class, 'register']);

// ---->>>>>>>> we will use policies inside the controllers to differentiate between admin and customer <<<<<<<---------------

 Route::middleware(['auth:sanctum'])->group(function () {
    // Common routes that both admin and customer can access
    Route::apiResource('users', UserController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('customers', CustomerController::class);

    // Route-specific middleware for admin-only routes
    // Route::middleware(['admin'])->group(function () {
    //     // No need to define specific routes here; they share the common routes above.
    //     // You can use policies to differentiate admin vs. customer permissions in controllers.
    // });
});



