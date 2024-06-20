<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TodoController;

Route::get('/todo',[TodoController::class, "getAll"]);
Route::get('/todo/{todoId}',[TodoController::class, "get"]);
Route::post('/todo',[TodoController::class, 'store']);
Route::delete('/todo/{id}', [TodoController::class, "destroy"]);
Route::put('/todo', [TodoController::class, "update"]);
Route::patch('/todo/{id}', [TodoController::class, "patch"]);



