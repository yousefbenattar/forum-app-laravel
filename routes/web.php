<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AiChatController;
use App\Http\Controllers\ActivityController;

Route::middleware(['auth'])->group(function () {
    Route::get('/ai/conversations', [AiChatController::class, 'index']);
    Route::get('/ai/conversations/{id}', [AiChatController::class, 'show']);
    Route::post('/ai-chat', [AiChatController::class, 'handle']);
});

Route::get('/', [PostController::class, 'index'])->name('dashboard');
Route::get('/category/{category::id}', [CategoryController::class, 'show']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/@{username}', [UserController::class, 'show']);


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/search', [SearchController::class, 'index'])->name('posts.search');
    Route::get('/myactvities', [ActivityController::class, 'index'])->name('actvities');


    Route::get('/post', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');

    Route::post('/comment', [CommentController::class, 'create']);
    Route::delete('/comment/{comment}', [CommentController::class, 'delete']);
    Route::post('/{post:id}/like', [LikeController::class, 'create']);

    Route::post('/follow/{user}', [FollowController::class, 'follow']);
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow']);
    Route::get('/{user_id}/bookmarks', [BookmarkController::class, 'show']);
    Route::post('/{post:id}/bookmark', [BookmarkController::class, 'create']);
    Route::delete('/{post:id}/unbookmark', [BookmarkController::class, 'delete']);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
