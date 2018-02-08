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

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'EstoqueController@select')->name('select');


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/paciente/cadastro', 'PacienteController@index');

Route::resource('/estadocivil', 'EstadoCivilController');

Route::resource('/prestador', 'PrestadorController');

Route::resource('/tipoprestador', 'TipoPrestadorController');

Route::resource('/ala', 'AlaController');

Route::resource('/tipoalta', 'TipoAltaController');

Route::group(['prefix'  =>  'estoque' ,'middleware' => ['role:admin']], function () {
    Route::resource('/setor', 'SetorController');
    Route::resource('/categoria', 'CategoriaController');
    Route::resource('/produto', 'ProdutoController');
    Route::resource('/estoque', 'EstoqueController');
    Route::get('/{estoque_id}/catrelposicaoestoque/{categoria_id}', 'ProdutoController@catrelposicaoestoque')->name('catrelposicaoestoque');

//    Route::get('/{estoque_id}/catrelposicaoestoque/{{categoria_id}}', 'ProdutoController@catrelposicaoestoque')->name('catrelposicaoestoque');

});

    Route::group(['prefix'  =>  'estoque' ,'middleware' => ['role:admin|estoque']], function () {
    //Route::group(['prefix'  =>  'estoque'], function () {
        // Route::resource('/setor', 'SetorController');
        // Route::resource('/categoria', 'CategoriaController');
        // Route::resource('/produto', 'ProdutoController');
        Route::get('/{id}/relposicaoestoque', 'ProdutoController@relposicaoestoque')->name('relposicaoestoque');
        // Route::get('/{id}/relposicaoestoque', 'EstoqueController@relposicaoestoque')->name('relposicaoestoque');
        Route::get('/{id}/entrada', ['as' => 'estoque.entrada','uses' => 'ProdutoEntradaController@index']);
        Route::get('/entrada/{id}/create', 'ProdutoEntradaController@create')->name('createentrada');
        Route::resource('/entrada', 'ProdutoEntradaController');
        Route::get('/{id}/saida', ['as' => 'estoque.saida','uses' => 'PedidoController@index']);
        Route::get('/{estoque_id}/pedido', ['as' => 'estoque.pedido','uses' => 'PedidoController@index']);
        Route::get('/saida/{id}/create', 'ProdutoSaidaController@create')->name('create');
        Route::get('/pedido/{estoque_id}/create', 'PedidoController@create')->name('create');
        // Route::get('/{id}/saida', 'ProdutoSaidaController@index')->name('index');
        Route::resource('/saida', 'ProdutoSaidaController');
        Route::resource('/pedido', 'PedidoController');
        // Route::resource('/estoque', 'EstoqueController');
        Route::post('/{id}/userstore', ['as' => 'estoque.userstore','uses' => 'EstoqueController@userstore']);
        Route::post('/{id}/produtostore', ['as' => 'estoque.produtostore','uses' => 'EstoqueController@produtostore']);

        // Route::get('/select', ['as' => 'estoque.select','uses' => 'EstoqueController@select']);
        Route::get('/select', 'EstoqueController@select')->name('select');
        Route::get('/{id}/menu', ['as' => 'estoque.menu','uses' => 'EstoqueController@menu']);

        });

        // Route::group(['prefix'  =>  'financeiro' ,'middleware' => ['role:admin']], function () {
        Route::group(['prefix'  =>  'financeiro' ], function () {
            Route::resource('/fornecedor', 'FornecedorController');
            Route::resource('/ordembancaria', 'OrdemBancariaController');
            // Route::get('/ordembancaria/print', 'OrdemBancariaController@print')->name('print');

            });



//Route::get('/paciente/cadastro', function () {
//    return 'Hello World';
//});
