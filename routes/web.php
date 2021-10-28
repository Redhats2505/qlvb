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

Route::get('/', 'DocumentController@index')-> middleware('auth');

Auth::routes();

Route::get('/home', 'DocumentController@index')->name('home');

Route::get('tailieu', 'DocumentController@index'); // Hiển thị danh sách tài liệu

Route::get('tailieu/create', 'DocumentController@create'); // Thêm mới tài liệu
Route::post('tailieu/create', 'DocumentController@store'); // Xử lý thêm mới tài liệu
Route::get('tailieu/{id}/edit', 'DocumentController@edit'); // Sửa tài liệu
Route::post('tailieu/update', 'DocumentController@update'); // Xử lý sửa tài liệu
Route::get('tailieu/{id}/delete', 'DocumentController@destroy'); // Xóa tài liệu
Route::get('tailieu/{id}', 'DocumentController@show'); // Hiển thị chi tiết tài liệu
Route::get('mail', 'EmailController@sendEMail');
Route::get('tailieu/{id}/download', 'DownloadController@download'); // Sửa tài liệu