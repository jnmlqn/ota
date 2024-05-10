<?php

use App\Http\Middleware\CheckQueryTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/unauthenticated', function () {
    return view('unauthenticated');
});

Route::get(
    '/job-posts/{id}/{status}', [
        App\Http\Controllers\JobPostsController::class, 'updateStatusViaEmail'
    ]
)->middleware([CheckQueryTokenMiddleware::class]);
