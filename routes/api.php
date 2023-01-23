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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/search', [
    App\Http\Controllers\UserController::class,
    'search',
]);

Route::get('/addresses', [
    App\Http\Controllers\AddressController::class,
    'index',
]);
Route::post('/addresses', [
    App\Http\Controllers\AddressController::class,
    'store',
]);
Route::get('/addresses/{address}', [
    App\Http\Controllers\AddressController::class,
    'show',
]);
Route::put('/addresses/{address}', [
    App\Http\Controllers\AddressController::class,
    'update',
]);
Route::delete('/addresses/{address}', [
    App\Http\Controllers\AddressController::class,
    'destroy',
]);
