<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TosController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect('/login');
})->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/discord', [LoginController::class, 'login'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
