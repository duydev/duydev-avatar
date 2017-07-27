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

Route::group(['middleware'=>'guest'],function(){
    Route::get('login', 'Auth\FBAuthController@login')->name('login');
    Route::get('fbcallback', 'Auth\FBAuthController@callback')->name('fbcallback');
});

Route::group(['middleware'=>'auth'],function(){
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('frame/create','FrameController@formCreate')->name('create_frame');
    Route::post('frame/create','FrameController@add');
    Route::post('slug', 'FrameController@slug')->name('slug');
});

Route::get('/','HomeController@index')->name('home');
Route::get('/{slug}', 'FrameController@showFrame')->name('show_frame');
Route::post('/{slug}/process', 'FrameController@processImage')->name('process_frame');

// Auth::routes();

