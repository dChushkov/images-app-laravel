<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/photos/create', [PhotoController::class, 'create'])->name('photos.create');
    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');
    Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
    Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/users', [AuthController::class, 'index'])->name('users.index');

    Route::get('/contact', [ContactMessageController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactMessageController::class, 'send'])->name('contact.send');

    Route::get('/profile', function () {
        return view('users.profile');
    })->name('profile');


    Route::prefix('admin')->group(function () {
        Route::get('/index', [AdminController::class, 'index'])->name('admin-index');
        Route::get('/photos', [AdminController::class, 'indexPhotos'])->name('admin.photos.index');
        Route::get('/photos/{photo}', [AdminController::class, 'show'])->name('admin.show');
        Route::delete('/comments/{comment}', [AdminController::class, 'deleteComment'])->name('admin.comments.delete');
        Route::get('/photos/{photo}/edit', [AdminController::class, 'editPhoto'])->name('admin.photos.edit');
        Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users.index');
        Route::get('/admin/users/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');
    });
});

Route::middleware(['guest'])->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});
