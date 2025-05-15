<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Autentikasi bawaan Laravel
Auth::routes();

// Route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    // User Management Routes with Soft Delete
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Soft Delete Additional Routes
        Route::post('/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');
    });
});

// Route untuk halaman landing (jika diperlukan)
Route::get('/welcome', function () {
    return view('welcome');
});
