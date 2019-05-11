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
//Route::post('/search', 'searchController@search');

Route::get('fetch_data/{id}','ajaxController@fetch_data');

Route::post('update_data','ajaxController@update_data')->name('seguimiento.update_data');

Route::post('delete_data', 'ajaxController@delete_data')->name('student.delete_data');

Route::get('/estadistica', 'EstadisticaController@view')->name('estadistica.view');

Route::any('/search','searchController@buscar');

Route::get('/titulados', 'EstadisticaController@search');

Route::get('/GraficaTitulados', 'EstadisticaController@datosGrafica');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/documentos','documentosController@mostar')->name('documentos.view');
//
// Route::get('documentos/{id}/pruebahtml','documentosController@prueba')->name('documentos.prueba');

Route::get('/file', 'FileController@mostrarDocumentos')->name('viewfile');

Route::get('/file/upload', 'FileController@nuevoDocumento')->name('formfile');

Route::post('/file/upload', 'FileController@guardarDocumento')->name('uploadfile');

Route::delete('/file/{id}', 'FileController@delete')->name('deletefile');

Route::get('/file/download/{id}', 'FileController@download')->name('downloadfile');
