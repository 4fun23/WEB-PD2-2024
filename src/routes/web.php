<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Use App\Http\Controllers\EnduserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\GameModeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/endusers', [EnduserController::class, 'list']);

Route::get('/endusers/create', [EnduserController::class, 'create']);
Route::post('/endusers/put', [EnduserController::class, 'put']);

Route::get('/endusers/update/{enduser}', [EnduserController::class, 'update']);
Route::post('/endusers/patch/{enduser}', [EnduserController::class, 'patch']);

Route::post('/endusers/delete/{enduser}', [EnduserController::class, 'delete']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

// Character routes
Route::get('/characters', [CharacterController::class, 'list']);
Route::get('/characters/create', [CharacterController::class, 'create']);
Route::post('/characters/put', [CharacterController::class, 'put']);
Route::get('/characters/update/{character}', [CharacterController::class, 'update']);
Route::post('/characters/patch/{character}', [CharacterController::class, 'patch']);
Route::post('/characters/delete/{character}', [CharacterController::class, 'delete']);

// GameModes routes
Route::get('/gameModes', [GameModeController::class, 'list']);
Route::get('/gameModes/create', [GameModeController::class, 'create']);
Route::post('/gameModes/put', [GameModeController::class, 'put']);
Route::get('/gameModes/update/{gameMode}', [GameModeController::class, 'update']);
Route::post('/gameModes/patch/{gameMode}', [GameModeController::class, 'patch']);
Route::post('/gameModes/delete/{gameMode}', [GameModeController::class, 'delete']);
