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
Auth::routes(['verify' => true]);
Route::get('/test', 'PagesController@test')->name('test');

Route::resource('users', 'UsersController', ['except' => ['index', 'destroy']]);
Route::get('/', 'TopicsController@index')->name('home');
Route::resource('topics', 'TopicsController', ['except' => ['show']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');