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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('books', 'BookController@index');
Route::get('books/{book_name}', 'BookController@show');

Route::get('rate/{rating}', 'BookController@rating');

Route::post('rate/{book_id}','BookController@rate')->name('rate');

Route::get('new_book', 'BookController@create')->middleware('auth')->name('create');
Route::post('new_book', 'BookController@store');