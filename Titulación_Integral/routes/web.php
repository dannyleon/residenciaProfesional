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

Route::resource('students','StudentController');

Route::post('/search', 'searchController@search');

Route::get('fetch_data/{id}','ajaxController@fetch_data');

Route::post('update_data','ajaxController@update_data')->name('seguimiento.update_data');

Route::post('delete_data', 'ajaxController@delete_data')->name('student.delete_data');
