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
Route::get('/admin', 'Auth\LoginController@loginForm')->name('admin.login');
Route::post('/admin', 'Auth\LoginController@login');

// proteger rutas con middleware AccessAdmin.php
Route::group(['middleware' => 'auth', 'auth.admin'], function () { 
    Route::get('/admin/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/admin/inicio', 'DashboardController@getInicio')->name('admin.inicio');
    Route::get('/admin/slider', 'DashboardController@getSlider')->name('admin.slider');
    Route::get('/admin/listarprograma', 'DashboardController@getPrograma')->name('admin.ListarPrograma');
    Route::get('/admin/listarservicio', 'DashboardController@getServicio')->name('admin.ListarServicio');
    Route::get('/admin/listarnoticia', 'DashboardController@getNoticia')->name('admin.Noticia');
});



//Route::get('dashboard', 'DashboardController@index')->name('dashboard');

// solo accedera a esta ruta los no autenticados
//Route::get('/', 'Auth\LoginController@showLoginForm')->middleware('guest')->name('inicio');

//Route::post('login', 'Auth\LoginController@login')->name('login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');


///Route::get('dashboard', 'DashboardController@index')->name('dashboard');

/* 
Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin', function(){
    return 'eres un administrador';
})->middleware(['auth', 'auth.admin']);*/
