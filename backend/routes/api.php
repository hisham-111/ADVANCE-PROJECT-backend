<?php

use App\Http\Controllers\currencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\goalController;

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


Route::Post('/goal',[GoalController::class,'addGoal']);
Route::Get('/goal/{id}',[GoalController::class,'getGoal']);
Route::Patch('/goal/{id}',[GoalController::class,'editGoal']);
Route::Delete('/goal/{id}',[GoalController::class,'deleteGoal']);
