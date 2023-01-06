<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Asset\InputFieldController;

Route::group(['prefix' => 'input-field'], function () {
    Route::get('datatable', [InputFieldController::class, 'datatable'])->name('input-field.datatable');
    Route::get('delete/{inputField}', [InputFieldController::class, 'delete'])->name('input-field.delete');
});

Route::resource('input-field', InputFieldController::class, [
    'except' => ['show'],
]);
