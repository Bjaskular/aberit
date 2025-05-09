<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/all', [UserController::class, 'all'])->name('all');
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/all', [PostController::class, 'all'])->name('all');
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::put('/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
});

Route::prefix('comments')->name('comments.')->group(function () {
    Route::get('/all', [CommentController::class, 'all'])->name('all');
    Route::get('/', [CommentController::class, 'index'])->name('index');
    Route::get('/{id}', [CommentController::class, 'show'])->name('show');
    Route::post('/', [CommentController::class, 'store'])->name('store');
    Route::put('/{id}', [CommentController::class, 'update'])->name('update');
    Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy');
});
