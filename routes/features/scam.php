<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bot\ScamController;

Route::group(['prefix' => 'scam'], function () {
    Route::get('post/{scam}', [ScamController::class, 'discordPost'])->name('scam.post');
    Route::get('datatable', [ScamController::class, 'datatable'])->name('scam.datatable');
    Route::get('delete/{scam}', [ScamController::class, 'delete'])->name('scam.delete');
    Route::get('status-update/{scam}', [ScamController::class, 'status'])->name('scam.status');
    Route::post('status-update/{scam}', [ScamController::class, 'statusUpdate'])->name('scam.status-update');
});

Route::resource('scam', ScamController::class, [
    'except' => ['show'],
]);
