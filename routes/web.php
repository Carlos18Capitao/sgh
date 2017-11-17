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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paciente/cadastro', 'PacienteController@index');

Route::resource('/estadocivil', 'EstadoCivilController');

Route::resource('/prestador', 'PrestadorController');

Route::resource('/tipoprestador', 'TipoPrestadorController');

Route::resource('/ala', 'AlaController');

Route::resource('/estoque/setor', 'SetorController');

Route::resource('/estoque/categoria', 'CategoriaController');

Route::resource('/estoque/produto', 'ProdutoController');
Route::get('/estoque/relposicaoestoque', 'ProdutoController@relposicaoestoque')->name('relposicaoestoque');

Route::resource('/estoque/entrada', 'ProdutoEntradaController');

Route::resource('/estoque/saida', 'ProdutoSaidaController');

//Route::get('/paciente/cadastro', function () {
//    return 'Hello World';
//});