<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bot\WebhookController;

Route::group(['prefix' => 'webhook'], function () {
    Route::get('datatable', [WebhookController::class, 'datatable'])->name('webhook.datatable');
    Route::get('delete/{webhook}', [WebhookController::class, 'delete'])->name('webhook.delete');
});

Route::resource('webhook', WebhookController::class, [
    'except' => ['show'],
]);
