<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NFT\MyNFTsController;

Route::group(['prefix' => 'my-nfts'], function(){
    Route::get('/',[MyNFTsController::class, 'index'])->name('my-nfts.index');
});
