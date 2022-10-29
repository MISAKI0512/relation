<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Middleware\FirstMiddleware;
use App\Http\Controllers\BookController;//追記

Route::get('/', [AuthorController::class, 'index']);
Route::get('/find', [AuthorController::class, 'find']);
Route::post('/find', [AuthorController::class, 'search']);

//Middleware
Route::get('/middleware',[AuthorController::class,'get']);
Route::post('/middleware',[AuthorController::class,'post'])->middleware(FirstMiddleware::class);


    Route::prefix('book') -> group(function (){
        Route::get('/',[BookController::class,'index']);
        Route::get('/add',[BookController::class,'add']);
        Route::post('/add',[BookController::class,'create']);
    });

    Route::get('/relation',[AuthorController::class,'relate']);

