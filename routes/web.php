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

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paciente/cadastro', 'PacienteController@index');

Route::resource('/estadocivil', 'EstadoCivilController');

Route::resource('/prestador', 'PrestadorController');

Route::resource('/tipoprestador', 'TipoPrestadorController');

Route::resource('/ala', 'AlaController');

Route::resource('/tipoalta', 'TipoAltaController');

Route::group(['prefix'  =>  'estoque' ,'middleware' => ['role:admin|estoque']], function () {
//Route::group(['prefix'  =>  'estoque'], function () {
    Route::resource('/setor', 'SetorController');
    Route::resource('/categoria', 'CategoriaController');
    Route::resource('/produto', 'ProdutoController');
    Route::get('/relposicaoestoque', 'ProdutoController@relposicaoestoque')->name('relposicaoestoque');
    Route::resource('/entrada', 'ProdutoEntradaController');
    Route::resource('/saida', 'ProdutoSaidaController');
    Route::resource('/estoque', 'EstoqueController');
    Route::post('/{id}/userstore', ['as' => 'estoque.userstore','uses' => 'EstoqueController@userstore']);
    // Route::get('/select', ['as' => 'estoque.select','uses' => 'EstoqueController@select']);
    Route::get('/select', 'EstoqueController@select')->name('select');

    });


//Route::get('/paciente/cadastro', function () {
//    return 'Hello World';
//});
