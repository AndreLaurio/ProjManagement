<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-room',[RoomController::class, 'create']);
Route::get('/rooms/{instructor_id}',[RoomController::class, 'get']);
Route::post('/join-room',[RoomController::class, 'joinRoom']);
Route::get('/examinee-rooms/{examinee_id}',[RoomController::class, 'getExamineeRoom']);
