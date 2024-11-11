<?php

use App\Http\Controllers\AdminBoardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/posts');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/logout', [SessionController::class, 'destroy']);


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminBoardController::class, 'index']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::delete('/dashboard/user/{user}', [AdminBoardController::class, 'destroy']);
    Route::put('/dashboard/user/{user}/role', [AdminBoardController::class, 'update']);
});
