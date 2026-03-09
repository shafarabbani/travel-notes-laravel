<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Beranda dialihkan ke daftar catatan
Route::get('/', function () {
    return redirect('/travel-notes');
});

// Rute Autentikasi (Hanya View)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Rute Catatan Perjalanan (Hanya View)
Route::group(['prefix' => 'travel-notes'], function () {
    Route::get('/', function () {
        return view('travel-notes.index');
    })->name('travel-notes.index');

    Route::get('/create', function () {
        return view('travel-notes.create');
    })->name('travel-notes.create');

    Route::get('/{id}', function ($id) {
        return view('travel-notes.show', ['id' => $id]);
    })->name('travel-notes.show');

    Route::get('/{id}/edit', function ($id) {
        return view('travel-notes.edit', ['id' => $id]);
    })->name('travel-notes.edit');
});
