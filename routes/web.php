<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TravelNoteController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to travel notes index
Route::get('/', function () {
    return redirect()->route('travel-notes.index');
});

// ── Authentication Routes ──────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ── Travel Notes Routes ────────────────────────────────────────────────────
Route::resource('travel-notes', TravelNoteController::class);

// ── Comments Routes ────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('travel-notes/{travelNote}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('travel-notes/{travelNote}/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});
