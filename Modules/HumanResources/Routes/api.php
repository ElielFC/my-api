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
        Route::post('/', 'UserController@getByFilter');
        Route::post('/store', 'UserController@store');
        Route::post('/{id}', 'UserController@show');
        Route::put('/{id}/update', 'UserController@update');
        Route::delete('/{id}/destroy', 'UserController@destroy');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::post('/', 'RoleController@getByFilter');
        Route::post('/store', 'RoleController@store');
        Route::post('/{id}', 'RoleController@show');
        Route::put('/{id}/update', 'RoleController@update');
        Route::delete('/{id}/destroy', 'RoleController@destroy');
    });
});
