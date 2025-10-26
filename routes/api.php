<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MessagesController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // posts handle
    Route::prefix('posts')->group( function () {
        Route::get('/', [PostsController::class, 'index']); //membaca data
        Route::post('/',[PostsController::class, 'store']); // Menyimpan data
        Route::get('{id}', [PostsController::class, 'show']); // Detail data
        Route::put('{id}', [PostsController::class, 'update']); // Mengedit Data
        Route::delete('{id}', [PostsController::class, 'destroy']); // Menghapus Data
    });

    // comments Handle
    Route::prefix('comments')->group(function() {
        Route::post('/', [CommentsController::class, 'store']);
        Route::delete('{id}', [CommentsController::class, 'destroy']);
    });

    // likes handle
    Route::prefix('likes')->group(function () {
        Route::post('/', [LikesController::class, 'store']);
        Route::delete('{id}', [LikesController::class, 'destroy']);
    });

    // messages Handle
    Route::prefix('messages')->group(function() {
        Route::post('/', [MessagesController::class, 'store']);
        Route::get('{id}', [MessagesController::class, 'show']);
        Route::delete('{id}', [MessagesController::class, 'destroy']);
    });
});
