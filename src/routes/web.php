<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Use App\Http\Controllers\EnduserController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/endusers', [EnduserController::class, 'list']);

Route::get('/endusers/create', [EnduserController::class, 'create']);
Route::post('/endusers/put', [EnduserController::class, 'put']);

Route::get('/endusers/update/{enduser}', [EnduserController::class, 'update']);
Route::post('/endusers/patch/{enduser}', [EnduserController::class, 'patch']);

Route::post('/endusers/delete/{enduser}', [EnduserController::class, 'delete']);
