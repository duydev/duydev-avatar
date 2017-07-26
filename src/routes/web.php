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

Route::group(['namespace'=>'Frontend'], function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware'=>'guest'],function (){
        Route::get('/fblogin', 'FBAuthController@login')->name('fblogin');
        Route::get('/fbcallback', 'FBAuthController@callback')->name('fbcallback');
    });


});


Route::get('/home', 'HomeController@index');

Auth::routes();

