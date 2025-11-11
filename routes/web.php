<?php

use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\PageController;

Route::middleware('web')->group(function () {
    Route::get('/about', [PageController::class, 'about']);
    Route::get('/contact', [PageController::class, 'contact'])->name('contact.form');
    Route::post('/contact', [ContactFormController::class, 'store'])->name('contact.store');

    Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe.store');

    Route::get('/', [PostController::class, 'index']);

    Route::get('/blog', [PostController::class, 'blog']);
    Route::get('/post/{post:slug}', [PostController::class, 'show']);
    Route::get('/search', [PostController::class, 'search'])->name('search');

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

    Route::middleware('auth')->group(function () {
        Route::get('admin', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('admin/dashboard/download', [DashboardController::class, 'download'])->name('admin.dashboard.download');
        Route::get('admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
        Route::get('admin/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
        Route::post('admin/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');
        Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

        Route::resource('admin/categories', CategoryController::class, ['as' => 'admin']);
        Route::resource('admin/contacts', ContactController::class, ['as' => 'admin']);
        Route::resource('admin/subscriptions', AdminSubscriptionController::class, ['as' => 'admin']);
    });
});