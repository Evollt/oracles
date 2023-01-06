<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bot\ScamCategoryController;

Route::group(['prefix' => 'scam-category'], function () {
    Route::get('datatable', [ScamCategoryController::class, 'datatable'])->name('scam-category.datatable');
    Route::get('delete/{scamCategory}', [ScamCategoryController::class, 'delete'])->name('scam-category.delete');
});

Route::resource('scam-category', ScamCategoryController::class, [
    'except' => ['show'],
]);
