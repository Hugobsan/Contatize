<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('autenticar');

Route::resource('users', UserController::class)->only(['create', 'store']);


Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', UserController::class)->only(['show', 'update', 'destroy']);
    Route::resource('contatos', ContatoController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
