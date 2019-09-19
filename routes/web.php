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
 

});
Route::get('admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
Route::get('admin/inicio', 'DashboardController@getInicio')->name('admin.inicio');


Route::get('admin/listarservicio', 'DashboardController@getServicio')->name('admin.ListarServicio');

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
Route::post('admin/agregar-programa', 'ProgramasController@nuevoPrograma');
Route::post('admin/informacion-programa', 'ProgramasController@infoPrograma');
Route::post('admin/editar-programa', 'ProgramasController@editarPrograma');
Route::post('admin/eliminar-programa', 'ProgramasController@eliminarPrograma');
Route::get('/programa/{nombre}','FrontendController@getProgramaByname');


// NOTICIA
Route::get('admin/listarnoticia', 'NoticiaController@index');
Route::get('admin/tablas/noticia', 'NoticiaController@getNoticiaTabla'); 
Route::post('admin/agregar-noticia', 'NoticiaController@nuevaNoticia');
Route::post('admin/informacion-noticia', 'NoticiaController@infoNoticia');
Route::post('admin/editar-noticia', 'NoticiaController@editarNoticia');
Route::post('admin/eliminar-noticia', 'NoticiaController@eliminarNoticia');
Route::get('/noticias', 'FrontendController@getNoticias');
Route::get('/noticia/{nombre}','FrontendController@getNoticiaByName');

// FOTOGRAFIA
Route::get('admin/fotografia/{id}', 'FotografiaController@getFotografiaVista'); 
Route::get('admin/tabla/fotografia/{id}', 'FotografiaController@getFotografiaTabla'); 
Route::post('admin/agregar-fotografia', 'FotografiaController@nuevaFotografia');
Route::post('admin/eliminar-fotografia', 'FotografiaController@eliminarFotografia');
Route::get('/galeria','FrontendController@getAllFotografias');
Route::get('/pagination/fetch_data', 'FotografiaController@fetch_data');

 

// SERVICIO
Route::get('admin/listarservicio', 'ServiciosController@index');
Route::get('admin/tablas/servicio', 'ServiciosController@getServicioTabla'); 
Route::post('admin/agregar-servicio', 'ServiciosController@nuevoServicio');
Route::post('admin/informacion-servicio', 'ServiciosController@infoServicio');
Route::post('admin/editar-servicio', 'ServiciosController@editarServicio');
Route::post('admin/eliminar-servicio', 'ServiciosController@eliminarServicio');
Route::get('admin/logout', 'Auth\LoginController@logout');
Route::get('/servicios','FrontendController@getAllServicios');
Route::get('/servicio/{nombre}','FrontendController@getServicioByname');


Route::get('/admin/editarusuario', 'UserController@index')->name('admin.EditarUsuario');
Route::post('/admin/actualizar-usuario','UserController@update');




