<?php

use App\Http\Controllers\currencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

// ************* GOAL CRUD *************

Route::post('/goal',[GoalController::class,'addGoal']);
Route::Get('/goal/{id}',[GoalController::class,'getGoal']);
Route::Patch('/goal/{id}',[GoalController::class,'editGoal']);
Route::Delete('/goal/{id}',[GoalController::class,'deleteGoal']);

// ************* GATEGORY CRUD *************

Route::Post('/category',[categoryController::class,'addCategory']);
Route::Get('/category/{id}',[categoryController::class,'getCategory']);
Route::Patch('/category/{id}',[categoryController::class,'editCategory']);
Route::Delete('/category/{id}',[categoryController::class,'deleteCategory']);

// ************* CURRENCY CRUD *************

Route::post('/currency',[currencyController::class,'addCurrency']);
Route::get('/currency',[currencyController::class,'getAllCurrency']);

