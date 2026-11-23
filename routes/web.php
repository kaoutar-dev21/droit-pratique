<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/a-propos', [PageController::class, 'about'])->name('about');

Route::get('/domaines', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/domaines/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware('guest')->group(function () {
    Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/connexion', [AuthController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/inscription', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');
    Route::post('/articles/{article:slug}/commentaires', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/commentaires/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', AdminMiddleware::class])
    ->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('articles', Admin\ArticleController::class)->except('show');
        Route::resource('categories', Admin\CategoryController::class)->except('show');

        Route::get('commentaires', [Admin\CommentController::class, 'index'])->name('comments.index');
        Route::delete('commentaires/{comment}', [Admin\CommentController::class, 'destroy'])->name('comments.destroy');

        Route::get('utilisateurs', [Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('utilisateurs/{user}/role', [Admin\UserController::class, 'toggleRole'])->name('users.role');
        Route::delete('utilisateurs/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');
    });