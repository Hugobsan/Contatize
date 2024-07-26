<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\CorsMiddleware;


//Adicionando Group para o middleware de CorsMiddleware
Route::group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('autenticar');

    Route::resource('users', UserController::class)->only(['create', 'store']);

    Route::group(['middleware' => 'auth'], function () {
        Route::resource('contatos', ContatoController::class);
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::put('password', [PasswordController::class, 'update'])->name('password.alterar');
    });
});
// ->middleware(CorsMiddleware::class);
