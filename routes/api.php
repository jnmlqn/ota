<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('/job-posts', [App\Http\Controllers\JobPostsController::class, 'index'])->middleware('ability:ota:job_view');
    Route::post('/job-posts', [App\Http\Controllers\JobPostsController::class, 'create'])->middleware('ability:ota:job_post');
    Route::put('/job-posts/{id}/{status}', [App\Http\Controllers\JobPostsController::class, 'updateStatus'])->middleware('ability:ota:job_status');
});
