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

Route::get('test', function(){
    return 'Hola Mundo';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Router::resource('/tareas', 'TareasController');
Route::group( [['middleware' => 'auth']] , function ()
{
	Route::resource('/tareas', 'TareasController');
});

// Agregando seguridad por Roles
Route::group(['middleware' => ['role:Administrador']], function () {
// Route::group(['middleware' => ['permission:destroy_tareas']], function () {
// Route::group(['middleware' => ['role:Administrador','permission:universal']], function () {

    Route::delete('tareas/{tarea}', 'TareasController@destroy')->name('tareas.destroy');
});
