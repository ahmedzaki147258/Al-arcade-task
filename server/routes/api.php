<?php

use App\Http\Controllers\CheckPointController;
use App\Http\Controllers\VideoLessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('videos', VideoLessonController::class);
Route::post('/videos/{videoLessonId}/checkpoints', [CheckPointController::class, 'store']);
Route::delete('/checkpoints/{id}', [CheckPointController::class, 'destroy']);
Route::get('/videos/{videoLessonId}/next-event', [CheckPointController::class, 'getNextEvent']);
