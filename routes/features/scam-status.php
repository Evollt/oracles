<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bot\ScamStatusController;

Route::group(['prefix' => 'scam-status'], function () {
    Route::get('datatable', [ScamStatusController::class, 'datatable'])->name('scam-status.datatable');
    Route::get('delete/{scamStatus}', [ScamStatusController::class, 'delete'])->name('scam-status.delete');
});

Route::resource('scam-status', ScamStatusController::class, [
    'except' => ['show'],
]);
