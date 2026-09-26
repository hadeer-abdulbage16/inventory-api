<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Inventory\CategoryController;
use App\Http\Controllers\Api\Inventory\ProductController;
use App\Http\Controllers\Api\Inventory\ProductStockController;
use App\Http\Controllers\Api\Inventory\StockMovementController;



Route::group(['prefix'=>'inventory' , 'middleware'=>'auth:sanctum'], function(){

//category end point 
    Route::group(['prefix'=>'category' ], function(){
        Route::get('/list' , [CategoryController::class , 'list'])->name('list');
        Route::post('/store' , [CategoryController::class , 'store'])->name('store');
        Route::post('/update/{id}' , [CategoryController::class , 'update'])->name('update');
        Route::post('/delete/{id}' , [CategoryController::class , 'delete'])->name('delete');
        Route::get('search' , [CategoryController::class , 'search'])->name('search');
    });
//product end point 
    Route::group(['prefix'=>'product' ], function(){
        Route::get('/list' , [ProductController::class , 'list'])->name('list');
        Route::post('/store' , [ProductController::class , 'store'])->name('store');
        Route::post('/update/{id}' , [ProductController::class , 'update'])->name('update');
        Route::post('/delete/{id}' , [ProductController::class , 'delete'])->name('delete');
        Route::get('search' , [ProductController::class , 'search'])->name('search');
    });
//product Stock end point 
    Route::group(['prefix'=>'product_stock' ], function(){
        Route::get('/list' , [ProductStockController::class , 'list'])->name('list');
        Route::post('/store' , [ProductStockController::class , 'store'])->name('store');
        Route::post('/update/{id}' , [ProductStockController::class , 'update'])->name('update');
        Route::post('/delete/{id}' , [ProductStockController::class , 'delete'])->name('delete');
        Route::get('search' , [ProductStockController::class , 'search'])->name('search');
    });
//Stock Movement  end point 
    Route::group(['prefix'=>'stock_movement' ], function(){
        Route::get('/list' , [StockMovementController::class , 'list'])->name('list');
    });


});


