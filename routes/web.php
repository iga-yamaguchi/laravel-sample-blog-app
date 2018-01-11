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

Route::get('/', 'ArticleController@index')->name('index');

Route::resource('article', 'ArticleController');
Route::get('article/year/{article}', 'ArticleController@year')->name('article.year');
Route::resource('tag', 'TagController');
Auth::routes();

Route::get('user/{user}', 'UserController@show')->name('user.show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('home/edit', 'HomeController@edit')->name('user.edit');
Route::put('home/edit', 'HomeController@update')->name('user.update');
