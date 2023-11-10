<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::post('/authorization', [LoginController::class, 'login']);
Route::get('/authorization', [LoginController::class, 'seen']);
Route::post('/registration', [RegisterController::class, 'signup']);
Route::get('/logout', [LogoutController::class, 'logout'])->middleware(Authenticate::class);
Route::post('/files', [FilesController::class, 'upload'])->middleware(Authenticate::class);
Route::put('/files/{file}', [FilesController::class, 'edit'])->middleware(Authenticate::class);
Route::delete('/files/{file}', [FilesController::class, 'delete'])->middleware(Authenticate::class);
Route::get('/files/{file}', [FilesController::class, 'download'])->middleware(Authenticate::class);
Route::post('/files/{file}/accesses', [AccessesController::class, 'add'])->middleware(Authenticate::class);
Route::delete('/files/{file}/accesses', [AccessesController::class, 'delete'])->middleware(Authenticate::class);
Route::get('/files/disk', [DisksController::class, 'show'])->middleware(Authenticate::class);
Route::get('/files/shared', [DisksController::class, 'show'])->middleware(Authenticate::class);

