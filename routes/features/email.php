<?php

use App\Http\Controllers\User\VerificationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'email'], function () {
    Route::get('sendemail', [VerificationController::class, 'sendEmail'])->name('verification.send');
    Route::get('verificationform', [VerificationController::class, 'showVerificationForm'])->name('verification.form');
    Route::post('checkverificationcode', [VerificationController::class, 'verify'])->name('verification.verify');
});
