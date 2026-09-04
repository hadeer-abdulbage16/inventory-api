<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Inventory\CategoryController;



Route::group(['prefix'=>'inventory' , 'middleware'=>'auth:sanctum'], function(){

//category end point 
    Route::group(['prefix'=>'category' ], function(){
        Route::get('/list' , [CategoryController::class , 'list'])->name('list');
        Route::post('/store' , [CategoryController::class , 'store'])->name('store');
        Route::post('/update/{id}' , [CategoryController::class , 'update'])->name('update');
        Route::post('/delete/{id}' , [CategoryController::class , 'delete'])->name('delete');
        Route::get('search' , [CategoryController::class , 'search'])->name('search');
    });

});


