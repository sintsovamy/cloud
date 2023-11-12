<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\LogoutController;

Route::post('/authorization', [LoginController::class, 'login'])->name('login');   //+
Route::post('/registration', [RegisterController::class, 'signup']);   //+
Route::middleware('auth:sanctum')->get('/logout', [LogoutController::class, 'logout']);
Route::post('/files', [FilesController::class, 'upload']);
Route::put('/files/{file}', [FilesController::class, 'edit']);
Route::delete('/files/{file}', [FilesController::class, 'delete']);
Route::get('/files/{file}', [FilesController::class, 'download']);
Route::post('/files/{file}/accesses', [AccessesController::class, 'add']);
Route::delete('/files/{file}/accesses', [AccessesController::class, 'delete']);
Route::get('/files/disk', [DisksController::class, 'show']);
Route::get('/files/shared', [DisksController::class, 'show']);

/* ВЕРНУТЬ МИДЛВЕЙРЫ */

