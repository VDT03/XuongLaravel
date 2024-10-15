<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')
    ->group(function(){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('logout', [AuthController::class, 'logout']);
    });

Route::apiResource('customers', CustomerController::class);




// Bài tập buổi 5 về api
Route::apiResource('projects', ProjectController::class);

Route::prefix('projects/{project}')->group(function () {
    Route::apiResource('tasks', TaskController::class);
});