<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bot\SubscriberController;

Route::group(['prefix' => 'subscriber'], function () {
    Route::get('datatable', [SubscriberController::class, 'datatable'])->name('subscriber.datatable');
    Route::get('delete/{subscriber}', [SubscriberController::class, 'delete'])->name('subscriber.delete');
});

Route::resource('subscriber', SubscriberController::class, [
    'except' => ['show'],
]);
