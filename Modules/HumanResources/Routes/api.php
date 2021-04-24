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
Route::group(['middleware' => 'apiJwt', 'namespace' => 'Api'], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->middleware('can:viewAny-user');
        Route::post('/store', 'UserController@store')->middleware('can:store-user');
        Route::get('/{id}', 'UserController@show')->middleware('can:view-user');
        Route::put('/{id}/update', 'UserController@update')->middleware('can:update-user');
        Route::delete('/{id}/destroy', 'UserController@destroy')->middleware('can:destroy-user');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->middleware('can:viewAny-role');
        Route::post('/store', 'RoleController@store')->middleware('can:store-user');
        Route::get('/{id}', 'RoleController@show')->middleware('can:view-user');
        Route::put('/{id}/update', 'RoleController@update')->middleware('can:update-user');
        Route::delete('/{id}/destroy', 'RoleController@destroy')->middleware('can:destroy-user');
    });
});
