<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Transactions\PurchaseController;
use App\Http\Controllers\Api\Transactions\SaleController;


Route::group(['prefix'=>'transaction' , 'middleware'=>'auth:sanctum'] , function(){
    //purchase
    Route::group(['prefix'=>'purchase'] , function(){
        Route::get('/list' , [PurchaseController::class , 'list'])->name('list');
        Route::post('/store' , [PurchaseController::class , 'store'])->name('store');

    });
    //sale
    Route::group(['prefix'=>'sale'] , function(){
        Route::get('/list' , [SaleController::class , 'list'])->name('list');
        Route::post('/store' , [SaleController::class , 'store'])->name('store');

    });

});