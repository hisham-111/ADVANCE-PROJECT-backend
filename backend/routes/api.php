<?php

use App\Http\Controllers\currencyController;
use App\Http\Controllers\FixedTransactionController;
use App\Models\FixedTransaction;
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
Route::post('/fixedtransaction',[FixedTransactionController::class,'addFixedTransaction']);
Route::patch('/fixedtransaction/{id}',[FixedTransactionController::class,'editFixedTransaction']);
Route::delete('/fixedtransaction/{id}',[FixedTransactionController::class,'deleteFixedTransaction']);
Route::get('/fixedtransaction',[FixedTransactionController::class,'getAllFixedTransactions']);
Route::get('/fixedtransaction/{id}',[FixedTransactionController::class,'getFixedTransaction']);

