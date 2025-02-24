<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaxonomyCatController;
use App\Http\Controllers\TaxonomyTagController;
use App\Livewire\Dashboard\Categories;
use App\Livewire\Dashboard\Comments\Comments;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Jobs\ManageJob;
use App\Livewire\Dashboard\Jobs\Jobs;
use App\Livewire\Dashboard\MediaLibrary;
use App\Livewire\Dashboard\Posts;
use App\Livewire\Dashboard\Tags;
use App\Livewire\Dashboard\Users\CreateUser;
use App\Livewire\Dashboard\Users\EditUser;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\UpdateLastActive;
use App\Livewire\Dashboard\Users\Users;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    $user = User::first();
    Session::put('user', $user);
    return view('home');
});

Route::middleware(['auth', 'not-subscriber', UpdateLastActive::class])->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', Dashboard::class)->name('dashboard');

    Route::get('/posts', Posts::class)->name('posts');
    Route::get('/categories', Categories::class)->name('categories');
    Route::get('/tags', Tags::class)->name('tags');
    Route::get('/comments', Comments::class)->name('comments');

    Route::get('/users', Users::class)->name('users');
    Route::get('/users/{user}/edit', EditUser::class)->name('users.edit');
    Route::get('/users/create', CreateUser::class)->name('users.create');

    Route::get('/jobs', Jobs::class)->name('jobs');
    Route::get('/jobs/manage', ManageJob::class)->name('jobs.manage');

    Route::get('/user/{id}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/media', MediaLibrary::class)->name('media');
});



Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
//    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('dashboard.users.create');
//    Route::post('/dashboard/users', [UserController::class, 'store'])->name('dashboard.users.store');
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

Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/{job:id}', [JobsController::class, 'show'])->name('jobs.show');

Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

