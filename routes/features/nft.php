<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NFT\NFTController;

Route::group(['prefix' => 'nft'], function(){
    Route::get('/{contract:address}/{nft:token_id}',[NFTController::class, 'index'])->name('nft.index');
    Route::get('/rental-information/{contract:address}/{nft:token_id}',[NFTController::class, 'rentalInformation'])->name('nft.rental-information');
    Route::get('/staking/{contract:address}/{nft:token_id}',[NFTController::class, 'staking'])->name('nft.staking');
    Route::get('datatable', [NFTController::class, 'transactionDatatable'])->name('nft.transaction.datatable');
});
