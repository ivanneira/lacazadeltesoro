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

// Example Routes


/*Dashboard*/
Route::get('/home', 'DashboardController@index')->name('home')->middleware('auth');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Auth::routes();
/*Login*/
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', function () {return redirect('login');});

Route::post('/upload', 'RutinasController@upload')->name('ckeditor.upload');
Route::get('/token', 'RutinasController@token')->name('ckeditor.token');


/* Alumnos */
Route::middleware(['auth'])->group(function () {
    Route::get('alumnos', 'AlumnosController@index');
    Route::get('alumnos/list', 'AlumnosController@list')->name('alumnos.list');
    Route::get('alumnos/edit/{id}', 'AlumnosController@edit')->name('alumnos.edit');
    Route::post('alumnos/store', 'AlumnosController@store')->name('alumnos.store');
    Route::delete('alumnos/{id}', 'AlumnosController@destroy')->name('alumnos.destroy');
    Route::get('alumnos/{id}', 'AlumnosController@show')->name('alumnos.show');
    Route::get('alumnos/dd/list', 'AlumnosController@Alumnos'); //->name('alumnos.dd');
    Route::get('alumnos/dd/item/{id}', 'AlumnosController@AlumnosDd');//->name('benefits.dd');

});

/* Pagos */
Route::middleware(['auth'])->group(function () {
    Route::get('pagos', 'PagosController@index');
    Route::get('pagos/list', 'PagosController@list')->name('pagos.list');
    Route::get('pagos/list/{id}', 'PagosController@listitem')->name('pagos.list.item');
    Route::delete('pagos/{id}', 'PagosController@destroy')->name('pagos.destroy');

    Route::get('pagos/edit/{id}', 'PagosController@edit')->name('pagos.edit');
    Route::post('pagos/store', 'PagosController@store')->name('pagos.store');
    Route::get('pagos/{id}', 'PagosController@show')->name('pagos.show');
});


/* Rutinas */
Route::middleware(['auth'])->group(function () {
    Route::get('rutinas', 'RutinasController@index');
    Route::get('rutinas/list', 'RutinasController@list')->name('rutinas.list');
    Route::get('rutinas/edit/{id}', 'RutinasController@edit')->name('rutinas.edit');
    Route::post('rutinas/store', 'RutinasController@store')->name('rutinas.store');
    Route::delete('rutinas/{id}', 'RutinasController@destroy')->name('rutinas.destroy');
    Route::get('rutinas/{id}', 'RutinasController@show')->name('rutinas.show');
    /* mapa */
Route::get('rutinas/show/map', 'RutinasController@showmap')->name('rutinas.showmap');


});

/* Dietas */
Route::middleware(['auth'])->group(function () {
    Route::get('dietas', 'DietasController@index');
    Route::get('dietas/list', 'DietasController@list')->name('dietas.list');
    Route::get('dietas/edit/{id}', 'DietasController@edit')->name('dietas.edit');
    Route::post('dietas/store', 'DietasController@store')->name('dietas.store');
    Route::delete('dietas/{id}', 'DietasController@destroy')->name('dietas.destroy');
    Route::get('dietas/{id}', 'DietasController@show')->name('dietas.show');


});


/* Recordatorios */
Route::middleware(['auth'])->group(function () {
    Route::get('recordatorios', 'RecordatoriosController@index');
    Route::get('recordatorios/list', 'RecordatoriosController@list')->name('recordatorios.list');
    Route::get('recordatorios/edit/{id}', 'RecordatoriosController@edit')->name('recordatorios.edit');
    Route::post('recordatorios/store', 'RecordatoriosController@store')->name('recordatorios.store');
    Route::delete('recordatorios/{id}', 'RecordatoriosController@destroy')->name('recordatorios.destroy');
    Route::get('recordatorios/{id}', 'RecordatoriosController@show')->name('recordatorios.show');

});


/* Calendario */
Route::middleware(['auth'])->group(function () {
    Route::get('calendario', 'CalendarioController@index');
    Route::get('calendario/list', 'CalendarioController@list')->name('calendario.list');
    Route::get('calendario/edit/{id}', 'CalendarioController@edit')->name('calendario.edit');
    Route::post('calendario/store', 'CalendarioController@store')->name('calendario.store');
    Route::delete('calendario/{id}', 'CalendarioController@destroy')->name('calendario.destroy');
    Route::get('calendario/{id}', 'CalendarioController@show')->name('calendario.show');
    Route::post('calendario/eventos', 'CalendarioController@eventos')->name('calendario.ventos');

});



Route::middleware(['auth'])->group(function () {

/*Users*/
Route::get('users', 'UsersController@index')->name('users');
Route::get('users/list', 'UsersController@list')->name('users.list');
Route::get('users/edit/{id}', 'UsersController@edit')->name('users.edit');
Route::post('users/store', 'UsersController@store')->name('users.store');
Route::delete('users/{id}', 'UsersController@destroy')->name('users.destroy');
Route::get('users/{id}', 'UsersController@show')->name('users.show');
Route::post('users/validar', 'UsersController@validar')->name('users.store');
Route::post('users/changepassword', 'UsersController@changepassword')->name('users.changepassword');

});

