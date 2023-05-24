<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;

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

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest:sanctum')
    ->name('login');
Route::get('/me', [AuthController::class, 'me'])
    ->middleware('auth:sanctum')
    ->name('me');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'v1/profile'
], function () {
    Route::get('/', [ProfileController::class, 'get']);
    Route::put('/', [ProfileController::class, 'update']);
    Route::patch('/', [ProfileController::class, 'change']);
});

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'v1/student'
], function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/', [StudentController::class, 'store']);
    Route::put('/{student}', [StudentController::class, 'update'])->whereUlid('student');
    Route::delete('/{student}', [StudentController::class, 'destroy'])->whereUlid('student');
});
