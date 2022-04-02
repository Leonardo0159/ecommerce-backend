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

    Route::prefix('size')->group(function() {
        Route::get('list', 'SizeController@listAll');
        Route::get('list/{id}', 'SizeController@getWithId');
        Route::post('save', 'SizeController@save');
        Route::post('save/{id}', 'SizeController@save');
        Route::delete('delete', 'SizeController@delete');
    });

    Route::prefix('product')->group(function() {
        Route::get('list', 'ProductController@listAll');
        Route::get('list/{id}', 'ProductController@getWithId');
        Route::post('save', 'ProductController@save');
        Route::post('save/{id}', 'ProductController@save');
        Route::delete('delete', 'ProductController@delete');
    });

    Route::prefix('inventory')->group(function() {
        Route::get('list', 'InventoryController@listAll');
        Route::get('list/{id}', 'InventoryController@getWithId');
        Route::post('save', 'InventoryController@save');
        Route::post('save/{id}', 'InventoryController@save');
        Route::delete('delete', 'InventoryController@delete');
    });

    Route::prefix('cart')->group(function() {
        Route::get('list', 'CartController@listAll');
        Route::get('list/{id}', 'CartController@getWithId');
        Route::post('save', 'CartController@save');
        Route::post('save/{id}', 'CartController@save');
        Route::delete('delete', 'CartController@delete');
    });
    Route::prefix('inventorycart')->group(function() {
        Route::get('list', 'InventoryCartController@listAll');
        Route::get('list/{id}', 'InventoryCartController@getWithId');
        Route::post('save', 'InventoryCartController@save');
        Route::post('save/{id}', 'InventoryCartController@save');
        Route::delete('delete', 'InventoryCartController@delete');
    });
});
