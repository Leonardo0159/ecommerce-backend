<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
Route::prefix('address')->group(function() {
    Route::get('list', 'AddressController@listAll');
    Route::get('list/{id}', 'AddressController@getWithId');
    Route::post('save', 'AddressController@save');
    Route::post('save/{id}', 'AddressController@save');
    Route::delete('delete', 'AddressController@delete');
});
Route::prefix('promotion')->group(function() {
    Route::get('list', 'PromotionController@listAll');
    Route::get('list/{id}', 'PromotionController@getWithId');
    Route::post('save', 'PromotionController@save');
    Route::post('save/{id}', 'PromotionController@save');
    Route::delete('delete', 'PromotionController@delete');
});
Route::prefix('order')->group(function() {
    Route::get('list', 'OrderController@listAll');
    Route::get('list/{id}', 'OrderController@getWithId');
    Route::post('save', 'OrderController@save');
    Route::post('save/{id}', 'OrderController@save');
    Route::delete('delete', 'OrderController@delete');
});
Route::prefix('permission')->group(function() {
    Route::get('list', 'PermissionController@listAll');
    Route::get('list/{id}', 'PermissionController@getWithId');
    Route::post('save', 'PermissionController@save');
    Route::post('save/{id}', 'PermissionController@save');
    Route::delete('delete', 'PermissionController@delete');
});
Route::prefix('permissionuser')->group(function() {
    Route::get('list', 'PermissionUserController@listAll');
    Route::get('list/{id}', 'PermissionUserController@getWithId');
    Route::post('save', 'PermissionUserController@save');
    Route::post('save/{id}', 'PermissionUserController@save');
    Route::delete('delete', 'PermissionUserController@delete');
});
Route::prefix('user')->group(function() {
    Route::get('list', 'UserController@listAll');
    Route::get('list/{id}', 'UserController@getWithId');
    Route::post('save', 'UserController@save');
    Route::post('save/{id}', 'UserController@save');
    Route::delete('delete', 'UserController@delete');
});
