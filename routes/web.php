<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function() {
    Route::prefix('category')->group(function() {
        Route::get('list', 'CategoryController@listAll');
        Route::get('list/{id}', 'CategoryController@getWithId');
        Route::post('save', 'CategoryController@save');
        Route::post('save/{id}', 'CategoryController@save');
        Route::delete('delete', 'CategoryController@delete');
    });

    Route::prefix('color')->group(function() {
        Route::get('list', 'ColorController@listAll');
        Route::get('list/{id}', 'ColorController@getWithId');
        Route::post('save', 'ColorController@save');
        Route::post('save/{id}', 'ColorController@save');
        Route::delete('delete', 'ColorController@delete');
    });
});
