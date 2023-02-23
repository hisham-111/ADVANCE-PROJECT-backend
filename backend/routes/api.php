<?php

use App\Http\Controllers\currencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/currency',[currencyController::class,'getAllCurrency']);
Route::get('/currency/{id}',[currencyController::class,'getCurrency']);
Route::post('/currency',[currencyController::class,'addCurrency']);
Route::Patch('/currency/{id}',[currencyController::class,'editCurrency']);
Route::delete('/currency/{id}',[currencyController::class,'deleteCurrency']);

