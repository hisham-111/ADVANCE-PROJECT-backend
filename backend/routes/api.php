<?php

use App\Http\Controllers\currencyController;
use App\Http\Controllers\RecurringController;
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
Route::patch('/currency/{id}',[currencyController::class,'editCurrency']);
Route::delete('/currency/{id}',[currencyController::class,'deleteCurrency']);

Route::get('/recurrings',[RecurringController::class,'index']);
Route::get('/recurrings/{id}',[RecurringController::class,'show']);
Route::post('/recurrings',[RecurringController::class,'store']);
Route::patch('/recurrings/{id}',[RecurringController::class,'edit']);
Route::delete('/recurrings/{id}',[RecurringController::class,'delete']);