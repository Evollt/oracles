<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\RoleController;
use App\Models\User\Role;

Route::group(['prefix' => 'roles'], function () {
    Route::get('datatable', [RoleController::class, 'datatable'])->name('roles.datatable');
    Route::get('delete/{role}', [RoleController::class, 'delete'])->name('roles.delete');
});

Route::resource('roles', RoleController::class, [
    'except' => ['show'],
]);

