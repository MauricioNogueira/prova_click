<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrutaController@index')->name('fruta.home');
Route::get('/fruta/create', 'FrutaController@create')->name('fruta.create');
Route::post('/fruta/store', 'FrutaController@store')->name('fruta.store');
Route::get('/fruta/list', 'FrutaController@fruitList')->name('fruta.list');

Route::get('/venda/receita', 'VendaController@receita')->name('venda.receita');
Route::get('/venda/listagem', 'VendaController@listagem')->name('venda.listagem');
Route::get('/venda/vendidos', 'VendaController@getVendas')->name('venda.vendidos');
Route::resource('venda', 'VendaController');
