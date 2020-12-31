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
Route::group(['middleware' => 'apiJwt', 'prefix' => 'user', 'namespace' => 'Api'], function () {
    Route::post('/', 'UserController@getByFilter');
    Route::post('/store', 'UserController@store');
    Route::post('/{id}', 'UserController@show');
    Route::put('/{id}/update', 'UserController@update');
    Route::delete('/{id}/destroy', 'UserController@destroy');
});
