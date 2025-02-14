<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaxonomyCatController;
use App\Http\Controllers\TaxonomyTagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\UpdateLastActive;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    $user = User::first();
    Session::put('user', $user);
    return view('home');
});

Route::middleware(['auth', 'not-subscriber', UpdateLastActive::class])->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
    Route::delete('/dashboard/posts/{post}', [PostController::class, 'destroy'])->name('dashboard.posts.destroy');

    Route::resource('users', UserController::class);

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs');

    Route::resource('comments', CommentController::class);
    Route::post('comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::post('comments/{id}/reject', [CommentController::class, 'reject'])->name('comments.reject');

    Route::get('/user/{id}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/{any}', function ($any) {
        return view('dashboard.' . $any);
    })->where('any', '.*')->name('dynamic');
});

Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/dashboard/users', [UserController::class, 'store'])->name('dashboard.users.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/profile/{user}/edit', [ProfileController::class, 'edit'])
        ->name('dashboard.profile.edit')
        ->middleware('profile');

    Route::put('/dashboard/profile/{user}', [ProfileController::class, 'update'])
        ->name('dashboard.profile.update')
        ->middleware('profile');
});

Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('category/{category:slug}', [TaxonomyCatController::class, 'show'])->name('category');
Route::get('tag/{tag:slug}', [TaxonomyTagController::class, 'show'])->name('tag');

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::get('blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

