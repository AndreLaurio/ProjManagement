<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ExamController;

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
Route::put('/update-room/{room_id}', [RoomController::class, 'update']);
Route::delete('/delete-room/{room_id}', [RoomController::class, 'delete']);
Route::get('/rooms/{instructor_id}',[RoomController::class, 'get']);
Route::post('/join-room',[RoomController::class, 'joinRoom']);
Route::get('/examinee-rooms/{examinee_id}',[RoomController::class, 'getExamineeRoom']);

// Exams
Route::get('/examiner/exams/{examiner_id}',[ExamController::class, 'getExaminerExam']);
Route::get('/exams/{room_id}', [RoomController::class, 'getExam']);

// Add New Exam
Route::post('/exam/details/save', [ExamController::class, 'saveExamDetail']);