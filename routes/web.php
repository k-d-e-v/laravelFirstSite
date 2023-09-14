<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CSVController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'showwelcome'])->middleware('guest');
Route::get('/register', [UserController::class, 'showregister'])->middleware('guest');
Route::post('/login', [UserController::class, 'login']);
Route::post('/store', [UserController::class, 'store']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/csv', [UserController::class, 'showcsv'])->middleware('auth');
Route::post('/addcsvfile', [CSVController::class, 'add'])->middleware('auth');
