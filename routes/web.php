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

// index
Route::get('/', 'FrontendController@index')->name('inicio');

// login administrador
Route::get('admin', 'Auth\LoginController@loginForm')->name('admin.login');
Route::post('admin', 'Auth\LoginController@login');

// proteger rutas con middleware AccessAdmin.php
Route::group(['middleware' => 'auth', 'auth.admin'], function () { 
    /*Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/admin/inicio', 'DashboardController@getInicio')->name('admin.inicio');
    Route::get('/admin/slider', 'DashboardController@getSlider')->name('admin.slider');
    Route::get('/admin/listarservicio', 'DashboardController@getServicio')->name('admin.ListarServicio');
    Route::get('/admin/listarnoticia', 'DashboardController@getNoticia')->name('admin.Noticia');*/

});
Route::get('admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
Route::get('admin/inicio', 'DashboardController@getInicio')->name('admin.inicio');


Route::get('admin/listarservicio', 'DashboardController@getServicio')->name('admin.ListarServicio');
Route::get('admin/listarnoticia', 'DashboardController@getNoticia')->name('admin.Noticia');

// SLIDER

Route::get('admin/listarslider', 'SliderController@index');
Route::get('admin/tablas/slider', 'SliderController@getSliderTabla');
Route::post('admin/agregar-slider', 'SliderController@nuevoSlider');
Route::post('admin/informacion-slider', 'SliderController@infoSlider');
Route::post('admin/editar-slider', 'SliderController@editarSlider');
Route::post('admin/eliminar-slider', 'SliderController@eliminarSlider');

// PROGRAMA
Route::get('admin/listarprograma', 'ProgramasController@index');
Route::get('admin/tablas/programa', 'ProgramasController@getProgramaTabla'); 


Route::get('admin/logout', 'Auth\LoginController@logout');


Route::get('/admin/editarusuario', 'UserController@index')->name('admin.EditarUsuario');
Route::post('/admin/actualizar-usuario','UserController@update');




