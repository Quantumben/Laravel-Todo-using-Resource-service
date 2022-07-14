<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\SubTodoController;
use App\Http\Controllers\UserController;
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

Route::get('/overdue/{id}', [TodoController::class, 'OverDue']);
Route::post('/CreateTodo', [TodoController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/completed/{id}', [TodoController::class, 'completed']);
Route::put('/reschedule/{id}', [TodoController::class, 'RescheduleTodo']);
Route::put('/UpdateTodo/{id}', [TodoController::class, 'update']);
Route::delete('/Delete/{id}', [TodoController::class, 'destroy']);



//SubTodo
Route::get('/suboverdue/{id}', [SubTodoController::class, 'OverDue']);
Route::post('/subcreate-todo', [SubTodoController::class, 'store']);
Route::post('/subcompleted/{id}', [SubTodoController::class, 'completed']);
Route::put('/subupdate-todo/{id}', [SubTodoController::class, 'update']);
Route::delete('/subdelete/{id}', [SubTodoController::class, 'destroy']);



});


//Authentication EndPoints
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
