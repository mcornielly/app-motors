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

// Route::get('/main', function () {
//     return view('container/container')->name('main');
// });

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['guest']], function(){
	Auth::routes();
	Route::get('/', 'Auth\LoginController@showLoginForm');
	Route::post('/login', 'Auth\LoginController@login')->name('login');
	// Route::post('/register', 'Auth\RegisterController@index')->name('register'); 
});

Route::group(['middleware' => ['auth']], function(){
	//Auth
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/logout','Auth\LoginController@logout')->name('logout');	

	Route::group(['middleware' => ['user']], function(){
		//Clients Module
		Route::resource('clientes', 'ClientController');
		Route::get('clientes/restaurar/{id}', 'ClientController@restore')->name('clients.restore');

		//Addresses Module
		Route::resource('direccion', 'AddressController');
	});

	Route::group(['middleware' => ['admin']], function(){
		//Clients Module
		Route::resource('clientes', 'ClientController');
		Route::get('clientes/restaurar/{id}', 'ClientController@restore')->name('clients.restore');

		//Addresses Module
		Route::resource('direccion', 'AddressController');

		//Users Module
		Route::resource('usuarios',  'UserController');
		Route::get('usuarios/restaurar/{id}', 'UserController@restore')->name('users.restore');

		//Roles
		Route::get('roles', 'RoleController@index')->name('roles.index');
		Route::get('roles/select_role', 'RoleController@select_role')->name('roles.select_role');
	});
});


