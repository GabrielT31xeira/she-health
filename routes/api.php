<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [\App\Http\Controllers\api\AuthController::class, 'login'])->name('login');
Route::post('register', [\App\Http\Controllers\api\AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('exam', [\App\Http\Controllers\home\ExameController::class, 'create']);
    Route::get('my-exam', [\App\Http\Controllers\home\ExameController::class, 'meusExames']);
    Route::delete('exam/{id}', [\App\Http\Controllers\home\ExameController::class, 'delete']);
    Route::get('profile', [\App\Http\Controllers\api\identifier\IdentifierController::class, 'profile']);
});
