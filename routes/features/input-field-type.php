<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Asset\InputFieldTypeController;

Route::group(['prefix' => 'input-field-type'], function () {
    Route::get('datatable', [InputFieldTypeController::class, 'datatable'])->name('input-field-type.datatable');
    Route::get('delete/{inputFieldType}', [InputFieldTypeController::class, 'delete'])->name('input-field-type.delete');
});

Route::resource('input-field-type', InputFieldTypeController::class, [
    'except' => ['show'],
]);
