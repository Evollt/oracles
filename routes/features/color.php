<?php

use App\Http\Controllers\Setting\ColorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'color'], function () {
    Route::get('datatable', [ColorController::class, 'datatable'])->name('color.datatable');
    Route::get('delete/{color}', [ColorController::class, 'delete'])->name('color.delete');
});

Route::resource('color', ColorController::class, [
    'except' => ['show'],
]);
