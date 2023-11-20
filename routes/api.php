<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AccessesController;

Route::post('/authorization', [LoginController::class, 'login'])->name('login');   
Route::post('/registration', [RegisterController::class, 'signup']);   
Route::middleware('auth:sanctum')->get('/logout', [LogoutController::class, 'logout']);   
Route::middleware('auth:sanctum')->post('/files', [FilesController::class, 'upload']);    
Route::middleware(['auth:sanctum', 'file.ex'])->post('/files/{file}/edit', [FilesController::class, 'edit']);   
Route::middleware(['auth:sanctum', 'file.ex'])->post('/files/{file}/delete', [FilesController::class, 'delete']); 
Route::middleware(['auth:sanctum', 'file.ex'])->get('/files/{file}', [FilesController::class, 'download']);   
Route::middleware(['auth:sanctum', 'file.ex'])->post('/files/{file}/accesses', [FilesController::class, 'giveAccess']);
Route::middleware(['auth:sanctum', 'file.ex'])->post('/files/{file}/accesses/delete', [FilesController::class, 'deleteAccess']);
Route::middleware('auth:sanctum')->get('/disk', [FilesController::class, 'showAll']);
Route::middleware('auth:sanctum')->get('/shared', [FilesController::class, 'showShared']);

