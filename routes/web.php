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
Route::get('/','ImageController@album');

Auth::routes();

/*IMAGE RESIZE*/
Route::get('/upload','ImageController@upload');
Route::post('/upload','ImageController@postUpload')->name('upload');
/*....*/
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/album','ImageController@store')->name('album.store');
Route::get('/album/create','ImageController@index');
Route::post('/album/image','ImageController@addImage')->name('album.image');

Route::get('/albums/{id}','ImageController@show');
Route::post('image/delete','ImageController@destroy')->name('image.delete');
Route::post('add/album/image','ImageController@albumImage')->name('add.album.image');



