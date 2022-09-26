<?php

use App\Http\Controllers\DahsboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OlahDataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'controller'=>LoginController::class,
], function(){
    Route::get('/','index')->name('login');
    Route::post('/auth','auth')->name('auth');
    Route::get('/logout','logout')->name('logout');
});

Route::group([
    'middleware'=>'auth',
], function(){
    Route::group([
        'as'=>'dashboard.',
        'controller'=>DahsboardController::class,
        'prefix'=>'/dashboard',
    ], function(){
        Route::get('/','index')->name('index');
    });

    Route::group([
        'as'=>'olahData.',
        'controller'=>OlahDataController::class,
        'prefix'=>'/olah-data',
        'middleware'=>'isLevelTwo',
    ], function(){
        Route::get('/','index')->name('index');
        Route::get('/search','search')->name('search');
        Route::get('/{id}/edit','edit')->name('edit');
        Route::post('/import','import')->name('import');
        Route::put('/upload/{id}','upload')->name('uploadFoto');
    });
});

