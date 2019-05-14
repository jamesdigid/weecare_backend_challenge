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

// Public
Route::group(['prefix'     => 'v1',], function() {
    Route::post('register', 'UserController@register')->name('api.register');
    Route::post('login', 'UserController@authenticate')->name('api.authenticate');
    Route::apiResource('albums', 'AlbumController');
    
    //Route::get('albums', 'AlbumController@getAlbums')->name('api.albums');
    //Route::get('albums/{id}', 'AlbumController@getAlbumIndex');


});

// Protected
Route::group([
    'middleware' => ['jwt.verify'],  
    'prefix'     => 'v1',], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
});

    /*

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// User //
Route::post('authenticate', 'AuthController@authenticate')->name('api.authenticate');
Route::post('register', 'AuthController@register')->name('api.register');


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    // Albums //
    Route::get('albums', 'AlbumController@getAlbums')->name('api.albums');
});*/