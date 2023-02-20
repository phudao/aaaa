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


Route::get('/addlog', 'HandoverController@addlog');
Route::post('/addlog', 'HandoverController@addlog');
Route::get('/list', 'HandoverController@listlog');
Route::post('/list', 'HandoverController@listlog');
Route::get('/editlog/{id}', 'HandoverController@editlog');
Route::post('/edit', 'HandoverController@edit');

Route::get('/login', 'Auth\LoginController@index')->name('login');;
Route::post('/login', 'Auth\LoginController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/forgot', 'Auth\ForgotPasswordController@index');

