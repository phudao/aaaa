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
Route::get('/detail/{id}', 'HandoverController@detail');

Route::get('/users', 'HandoverController@listuser');

Route::get('/', 'Auth\LoginController@index')->name('login');
Route::post('/', 'Auth\LoginController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/forgot', 'Auth\ForgotPasswordController@index');//chuyen sang HandoverController
Route::post('/forgot', 'Auth\ForgotPasswordController@index');//chuyen sang HandoverController
Route::get('/changepassword', 'Auth\LoginController@changepassword')->name('changepassword');//chuyen sang HandoverController
Route::post('/changepassword', 'Auth\LoginController@changepassword');
Route::get('/generatepass/{email}', 'Auth\ForgotPasswordController@generatepass');

Route::get('/report_weekly', 'HandoverController@reportWeekly');
Route::post('/report_weekly', 'HandoverController@reportWeekly');
Route::get('/send-email', 'HandoverController@sendEmail');
Route::get('/generate-pdf','HandoverController@generatepdf');
Route::get('/calendar','HandoverController@calendar');
Route::get('/editexchange/{id}','HandoverController@editexchange');

Route::post('/addexchangeworklog','HandoverController@addexchangeworklog');
Route::get('/printexchangework/{id}','HandoverController@printexchangework');
Route::get('/delaaa/{id}','HandoverController@delaaa');