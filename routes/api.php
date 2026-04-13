<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TravelNoteController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth:api'], function () {
    // Travel Notes
    Route::apiResource('travel-notes', TravelNoteController::class);

    // Comments
    Route::get('travel-notes/{travelNote}/comments', [CommentController::class, 'indexByTravelNote']);
    Route::post('travel-notes/{travelNote}/comments', [CommentController::class, 'store']);
    Route::put('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
});
