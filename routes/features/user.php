<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('datatable', [UserController::class, 'datatable'])->name('users.datatable');

    //deactive users toggle
    Route::get('active-modal/{user}', [UserController::class, 'activeModal'])->name('users.active-modal');
    Route::post('active-toggle/{user}', [UserController::class, 'toggleActive'])->name('users.active-toggle');

    //update roles
    Route::get('role-modal/{user}', [UserController::class, 'roleModal'])->name('users.role-modal');
    Route::post('role-update/{user}', [UserController::class, 'roleUpdate'])->name('users.role-update');


    //wallet
    Route::get('/wallet', [UserController::class, 'wallet'])->name('users.wallet');
});

Route::resource('users', UserController::class, [
    'except' => ['create', 'destroy', 'edit', 'update'],
]);
