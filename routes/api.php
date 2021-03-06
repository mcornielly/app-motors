<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('clientes/buscar/{field}/{query}', 'ClientController@search');
Route::get('direcciones/buscar/{field}/{query}', 'AddressController@search');
Route::get('roles/buscar/{field}/{query}', 'RoleController@search');
Route::get('usuarios/buscar/{field}/{query}', 'UserController@search');
