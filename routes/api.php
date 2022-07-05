<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Authenticated;
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


//Public EndPoints
Route::get('/getTodo', [TodoController::class,'getTodo']);
Route::get('/getTodo/{id}', [TodoController::class, 'show']);
Route::get('/TodoActivities', [TodoController::class, 'todo']);



//Protected EndPoints
Route::group(['middleware' => ['auth:sanctum']], function () {

Route::post('/CreateTodo', [TodoController::class, 'store']);
Route::put('/UpdateTodo/{id}', [TodoController::class, 'update']);
Route::delete('/Delete/{id}', [TodoController::class, 'destroy']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/completed/{id}', [TodoController::class, 'completed']);
Route::get('/overdue/{id}', [TodoController::class, 'OverDue']);


});


//Authentication EndPoints
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
