<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AiChatController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;



Route::livewire('/','pages::posts.index')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/search', [SearchController::class, 'index'])->name('posts.search');

    Route::get('/myactvities', [ActivityController::class, 'index'])->name('actvities');
    Route::get('/myactvities', [ActivityController::class, 'index'])->name('actvities');



    Route::get('/post', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
    Route::livewire('/posts/{post}', 'pages::posts.index')->name('posts.show');


    Route::post('/comment', [CommentController::class, 'create']);
    Route::delete('/comment/{comment}', [CommentController::class, 'delete']);
    Route::post('/{post:id}/like', [LikeController::class, 'create']);
    Route::post('/follow/{user}', [FollowController::class, 'follow']);
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow']);

    Route::livewire('/bookmarks','pages::bookmark.index')->name('bookmark.index');
    Route::livewire('/chat/{conversation?}', 'pages::chat.index')->name('chat.index');
    Route::livewire('/ai', 'pages::chat_ai.index')->name('ai.index');
    Route::livewire('/dashboard', 'pages::admin.index')->name('admin.dashboard');
    Route::livewire('/admin/users', 'pages::admin.users')->name('admin.users');
    Route::livewire('/admin/logs', 'pages::admin.logs')->name('admin.logs');
    Route::livewire('/admin/moderation', 'pages::moderation.index')->name('moderation.index');

    Route::get('/ai/conversations/{id}', [AiChatController::class, 'show']);
    Route::post('/ai-chat', [AiChatController::class, 'handle']);


    Route::post('/{post:id}/bookmark', [BookmarkController::class, 'create']);
    Route::delete('/{post:id}/unbookmark', [BookmarkController::class, 'delete']);
    Route::get('/category/{category::id}', [CategoryController::class, 'show']);

    Route::get('/@{username}', [UserController::class, 'show']);
    Route::post('/conversations/{id}', [ConversationController::class, 'create']);
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/news',[NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create',[NewsController::class, 'create'])->name('news.create');
    Route::post('/news/store',[NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}',[NewsController::class, 'show'])->name('news.show');


    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
