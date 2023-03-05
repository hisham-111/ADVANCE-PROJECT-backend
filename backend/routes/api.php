<?php

use App\Http\Controllers\currencyController;
use App\Http\Controllers\RecurringController;
use App\Http\Controllers\FixedTransactionController;
use App\Models\FixedTransaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\KeyController;


use App\Http\Controllers\GoalController;
use App\Http\Controllers\categoryController;


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
Route::get('/fixedtransaction/{id}',[FixedTransactionController::class,'getFixedTransactionById']);
Route::get('/fixedtransaction', [FixedTransactionController::class,'getBy']);



//UserController
Route::Get('/user',[UserController::class,'getAllUser']);
Route::Get('/user/{id}',[UserController::class,'getUser']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [UserController::class, 'logout']);
});
Route::delete('/user/{id}',[UserController::class,'destroyUser']);
Route::Patch('/user/{id}',[UserController::class,'editUser']);







//KeyController
Route::Get('/key',[KeyController::class,'getAllFixed_Key']);
Route::Get('/key/{id}',[KeyController::class,'getFixed_key']);
Route::Post('/key',[KeyController::class,'CreatFixed_Key']);
Route::delete('/key/{id}',[KeyController::class,'destroyFixed_Key']);
Route::Patch('/key/{id}',[KeyController::class,'editFixed_Key']);




// AuthenticationController
// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('user', [AuthController::class, 'user']);
//     Route::post('logout', [AuthController::class, 'logout']);
// });





// currency Routes
Route::get('/currency',[currencyController::class,'getAllCurrency']);
Route::get('/currency/{id}',[currencyController::class,'getCurrency']);
Route::post('/currency',[currencyController::class,'addCurrency']);
Route::patch('/currency/{id}',[currencyController::class,'editCurrency']);
Route::delete('/currency/{id}',[currencyController::class,'deleteCurrency']);

//recurrings Routes
Route::get('/recurrings',[RecurringController::class,'index']);
Route::get('/recurrings/{id}',[RecurringController::class,'show']);
Route::post('/recurrings',[RecurringController::class,'store']);
Route::patch('/recurrings/{id}',[RecurringController::class,'edit']);
Route::delete('/recurrings/{id}',[RecurringController::class,'delete']);




//Cataegories Routes
Route::get('/categories',[categoryController::class,'getAllCategory']);
Route::get('/categories/{id}',[categoryController::class,'getCategory']);
Route::post('/categories',[categoryController::class,'addCategory']);
Route::patch('/categories/{id}',[categoryController::class,'editCategory']);
Route::delete('/categories/{id}',[categoryController::class,'deleteCategory']);