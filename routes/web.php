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

Route::group(['prefix'  =>  'estoque' ,'middleware' => ['role:admin|superadministrator']], function () {
    Route::resource('/setor', 'SetorController');
    Route::resource('/categoria', 'CategoriaController');
    Route::resource('/estoque', 'EstoqueController');
    Route::get('/{estoque_id}/catrelposicaoestoque/{categoria_id}', 'ProdutoController@catrelposicaoestoque')->name('catrelposicaoestoque');

//    Route::get('/{estoque_id}/catrelposicaoestoque/{{categoria_id}}', 'ProdutoController@catrelposicaoestoque')->name('catrelposicaoestoque');

});

    Route::group(['prefix'  =>  'estoque' ,'middleware' => ['role:admin|estoque|consulta|superadministrator']], function () {
        Route::resource('/empresa', 'EmpresaController');

        Route::get('/{id}/relposicaoestoque', 'ProdutoController@relposicaoestoque')->name('relposicaoestoque');
        Route::get('/{id}/relposicaoestoquesemzero', 'ProdutoController@relposicaoestoquesemzero')->name('relposicaoestoquesemzero');
        Route::get('/{id}/pdfposicaoestoque', 'ProdutoController@pdfposicaoestoque')->name('pdfposicaoestoque');
        Route::get('/{id}/pdfposicaoestoquesemzero', 'ProdutoController@pdfposicaoestoquesemzero')->name('pdfposicaoestoquesemzero');

        Route::get('/{id}/reldemandaestoque', 'EstoqueController@reldemandaestoque')->name('reldemandaestoque');
        Route::any('/{id}/relLoteValidade', 'EstoqueController@relLoteValidade')->name('relLoteValidade');

        Route::get('/{id}/entradaestoque', ['as' => 'estoque.entradaestoque','uses' => 'ProdutoEntradaController@index']);
        Route::get('/entradaestoque/{id}/create', 'ProdutoEntradaController@create')->name('createentrada');
        Route::resource('/entradaestoque', 'ProdutoEntradaController');

        Route::resource('/pedido', 'PedidoController');
        Route::get('/{id}/saida', ['as' => 'estoque.saida','uses' => 'PedidoController@index']);
        Route::get('/{estoque_id}/pedido', ['as' => 'estoque.pedido','uses' => 'PedidoController@index']);
        Route::get('/pedido/{estoque_id}/create', 'PedidoController@create')->name('pedidoestoque');
        Route::any('/{estoque_id}/negados', 'PedidoController@negados')->name('negados');
        Route::post('/pedido/select-ajax', ['as'=>'select-ajax','uses'=>'PedidoController@selectAjax']);
        Route::post('/pedido/select-validade', ['as'=>'select-validade','uses'=>'PedidoController@selectValidade']);
        Route::post('/pedido/select-qtd', ['as'=>'select-qtd','uses'=>'PedidoController@selectQtd']);

        Route::get('/{id}/recibopedidoestoque', 'PedidoController@recibopedidoestoque')->name('recibopedidoestoque');


        Route::get('/saida/{id}/create', 'ProdutoSaidaController@create')->name('create');
        Route::resource('/saida', 'ProdutoSaidaController');

        Route::resource('/entrada', 'EntradaController');
        Route::get('/{estoque_id}/entrada', ['as' => 'estoque.entrada','uses' => 'EntradaController@index']);
        Route::get('/entrada/{estoque_id}/create', 'EntradaController@create')->name('entrarnf');

//        Route::get('/{id}/entrar', ['as' => 'estoque.entrar','uses' => 'PedidoController@index']);

        Route::post('/{id}/userstore', ['as' => 'estoque.userstore','uses' => 'EstoqueController@userstore']);
        Route::post('/{id}/produtostore', ['as' => 'estoque.produtostore','uses' => 'EstoqueController@produtostore']);
        Route::get('/select', 'EstoqueController@select')->name('select');
        Route::get('/{id}/menu', ['as' => 'estoque.menu','uses' => 'EstoqueController@menu']);

        Route::resource('/processo', 'ProcessoController');
        Route::resource('/empenho', 'EmpenhoController');
        Route::resource('/itemempenho', 'ItemEmpenhoController');
        Route::get('/produto/print/{id}', 'ProdutoController@pdfproduto')->name('pdfproduto');

        Route::resource('/produto', 'ProdutoController');

        //Route::group(['prefix'  =>  'estoque'], function () {
        // Route::resource('/setor', 'SetorController');
        // Route::resource('/categoria', 'CategoriaController');
        // Route::resource('/produto', 'ProdutoController');
        // Route::get('/{id}/relposicaoestoque', 'EstoqueController@relposicaoestoque')->name('relposicaoestoque');
        // Route::get('/{id}/saida', 'ProdutoSaidaController@index')->name('index');
        // Route::resource('/estoque', 'EstoqueController');
        // Route::get('/select', ['as' => 'estoque.select','uses' => 'EstoqueController@select']);

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
