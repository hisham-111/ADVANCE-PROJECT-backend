<?php

use App\Http\Controllers\currencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KeyController;

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



//UserController
Route::Get('/user',[UserController::class,'getAllUser']);
Route::Get('/user/{id}',[UserController::class,'getUser']);
Route::Post('/user',[UserController::class,'CreateUser']);
Route::delete('/user/{id}',[UserController::class,'destroyUser']);
Route::Patch('/user/{id}',[UserController::class,'editUser']);







//KeyController
Route::Get('/key',[KeyController::class,'getAllFixed_Key']);
Route::Get('/key/{id}',[KeyController::class,'getFixed_key']);
Route::Post('/key',[KeyController::class,'CreatFixed_Key']);
Route::delete('/key/{id}',[KeyController::class,'destroyFixed_Key']);
Route::Patch('/key/{id}',[KeyController::class,'editFixed_Key']);


