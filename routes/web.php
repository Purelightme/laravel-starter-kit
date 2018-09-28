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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');


/**
 * demo url
 */
Route::prefix('demo')->group(function (){
    Route::prefix('socialite')->group(function (){
        Route::get('redirect','Demo\SocialiteController@redirect');
        Route::get('callback','Demo\SocialiteController@callback');
        Route::get('api','Demo\SocialiteController@api');
    });
    Route::prefix('passport')->group(function (){
        Route::get('index','Demo\PassportController@index');
        Route::get('callback','Demo\PassportController@callback');
    });
    Route::prefix('upload')->group(function (){
        Route::post('single','Demo\UploadController@single');
        Route::post('multi','Demo\UploadController@multi');
    });
});
Route::prefix('test')->group(function (){
    Route::get('index','TestController@index');
});

