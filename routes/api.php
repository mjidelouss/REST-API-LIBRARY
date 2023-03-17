<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forget-password', [PasswordResetController::class, 'sendEmail']);
    Route::post('reset-password', [NewPasswordController::class, 'passwordResetProcess']);

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::put('user/{user}', 'update')->middleware('permission:edit my profile|edit every profile');
        Route::delete('user/{user}', 'destroy')->middleware('permission:delete my profile|delete every profile');
    });

    // Books
    Route::group(['controller' => BookController::class], function ()
    {
        Route::get('books', 'index');
        Route::post('book', 'store')->middleware('permission:add book');
        Route::get('book/{id}', 'show');
        Route::put('book/{id}', 'update')->middleware('permission:edit every book|edit my book');
        Route::delete('book/{id}', 'destroy')->middleware('permission:delete every book|delete my book');
    });

    // Filter By Genre
    Route::get('filter/{genre}', [BookController::class, 'filter']);

    // Genres
    Route::group(['controller' => GenreController::class], function ()
    {
        Route::get('genres', 'index')->middleware('permission:show genre');
        Route::post('genre', 'store')->middleware('permission:add genre');
        Route::get('genre/{id}', 'show')->middleware('permission:show genre');
        Route::put('genre/{id}', 'update')->middleware('permission:edit genre');
        Route::delete('genre/{id}', 'destroy')->middleware('permission:delete genre');
    });
});