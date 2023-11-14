<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\LogoutController;

Route::post('/authorization', [LoginController::class, 'login'])->name('login');   //+
Route::post('/registration', [RegisterController::class, 'signup']);   //+
Route::middleware('auth:sanctum')->get('/logout', [LogoutController::class, 'logout']);   //+
Route::middleware('auth:sanctum')->post('/files', [FilesController::class, 'upload']);    //+
Route::middleware('auth:sanctum')->get('/files', [FilesController::class, 'index']);    //+
Route::middleware('auth:sanctum')->post('/files/{file}', [FilesController::class, 'edit']);   //+
Route::middleware('auth:sanctum')->post('/files/{file}', [FilesController::class, 'delete']);
Route::middleware('auth:sanctum')->get('/files/{file}', [FilesController::class, 'download']);   //+
Route::middleware('auth:sanctum')->post('/files/{file}/accesses', [AccessesController::class, 'add']);
Route::middleware('auth:sanctum')->delete('/files/{file}/accesses', [AccessesController::class, 'delete']);
Route::middleware('auth:sanctum')->get('/files/disk', [DisksController::class, 'show']);
Route::middleware('auth:sanctum')->get('/files/shared', [DisksController::class, 'show']);

/* ВЕРНУТЬ МИДЛВЕЙРЫ */

