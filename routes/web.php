<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthenticationController::class, 'register']);
//login user
Route::post('/login', [AuthenticationController::class, 'login']);
//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/csv', function (Request $request) {
        return auth()->user();
    });
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
