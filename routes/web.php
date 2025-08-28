<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;




Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.post');
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');


Route::get('/', function () {
    return Inertia::render('Home');
});
Route::get('/settings', function () {
    return Inertia::render('Settings');
});

Route::get('/users', [UserController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/users/create', [UserController::class, 'create']);

    Route::post('/users', [UserController::class, 'store']);

    Route::get('users/{id}/edit', [UserController::class, "show"]);

    Route::put('/users/{id}', [UserController::class, 'update']);

    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
