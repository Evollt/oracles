<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setting\FilterContractController;

Route::group(['prefix' => 'settings'], function () {
    Route::group(['prefix' => 'filter-contract'], function () {
        Route::get('datatable', [FilterContractController::class, 'datatable'])->name('filter-contract.datatable');

        //delete filter-contract
        Route::get('delete-modal/{filter_contract}', [FilterContractController::class, 'deleteModal'])->name('filter-contract.delete-modal');
    });

    Route::resource('filter-contract', FilterContractController::class, [
        'except' => ['show'],
    ]);
});

