<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'account'], function () {
    //Profile
    Route::get('profile', [ProfileController::class, 'profile'])->name('user.account.profile');
    Route::get('profile/create-key-modal', [ProfileController::class, 'generateApiKeyModal'])->name('user.account.profile.generate-key-modal');
    Route::post('profile/create-key', [ProfileController::class, 'createApiKey'])->name('user.account.profile.generate-key');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('user.account.profile.update');

    // Security
    Route::get('security', [ProfileController::class, 'security'])->name('user.account.security');
    Route::post('security/update', [ProfileController::class, 'updateSecurity'])->name('user.account.security.update');
    Route::get('delete', [ProfileController::class, 'delete'])->name('user.account.delete');
    Route::post('destory', [ProfileController::class, 'destroy'])->name('user.account.destroy');

    // Notifications
    Route::get('notifications', [ProfileController::class, 'notifications'])->name('user.account.notifications');
    Route::post('notifications/update', [ProfileController::class, 'updateNotifications'])->name('user.account.notifications.update');
});

//Public profile
Route::get('/profile/{user:guid}', [ProfileController::class, 'showPublicProfile'])->name('profile.public');
