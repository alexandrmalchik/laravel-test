<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'list');
    Route::get('/product/{product}', 'show');
    Route::post('/product', 'create');
    Route::put('/product/{product}', 'update');
    Route::delete('/product/{product}', 'delete');
});
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'list');
    Route::get('/category/{category}', 'show');
    Route::post('/category', 'create');
    Route::put('/category/{category}', 'update');
    Route::delete('/category/{category}', 'delete');
});
