<?php

use App\Http\Middleware\CheckQueryTokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {  
    return Inertia\Inertia::render('Index');  
});

Route::get('/employer', function () {  
    return Inertia\Inertia::render('Employer');  
});

Route::get('/seeker', function () {  
    return Inertia\Inertia::render('Seeker');  
});

Route::get('/job-board', function () {  
    return Inertia\Inertia::render('JobBoard');  
});

Route::get('/create-job', function () {  
    return Inertia\Inertia::render('CreateJob');  
});

Route::get('/unauthenticated', function () {
    return view('unauthenticated');
});

Route::get(
    '/job-posts/{id}/{status}', [
        App\Http\Controllers\JobPostsController::class, 'updateStatusViaEmail'
    ]
)->middleware([CheckQueryTokenMiddleware::class]);
