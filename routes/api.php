<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/{todo_list_id}', [TaskController::class, 'getTasksByTodoListId']); //get tasks associate to a todoList

Route::prefix('/task')->group(function() {
    Route::post('/store', [TaskController::class, 'store']);
    Route::put('/update/{id}', [TaskController::class, 'update']);
    Route::put('/{id}', [TaskController::class, 'switchCompleted']);

    Route::delete('/{id}', [TaskController::class, 'destroy']);
});


Route::get('/todoLists', [TodoListController::class, 'index']);
Route::prefix('/todoList')->group(function() {
    Route::post('/store', [TodoListController::class, 'store']);
    Route::delete('/{id}', [TodoListController::class, 'destroy']);
});
