<?php

use App\Http\Controllers\TodoController;
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

Route::get('/getTodo', [TodoController::class,'getTodo']);
Route::get('/getTodo/{id}', [TodoController::class, 'show']);
Route::post('/CreateTodo', [TodoController::class, 'store']);
Route::put('/UpdateTodo/{id}', [TodoController::class, 'update']);
Route::delete('/Delete/{id}', [TodoController::class, 'destroy']);
