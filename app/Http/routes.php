<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
  error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Page Routes
 */
Route::get('/', 'PageController@dashboard');

/**
 * User Routes
 */
Route::get('alterar-senha', 'UserController@editPassword');
Route::post('updatePassword/{user}', 'UserController@updatePassword');
Route::resource('users', 'UserController');

/**
 * Role Routes
 */
Route::resource('roles', 'RoleController');

/**
 * Permission Routes
 */
Route::resource('permissions', 'PermissionController');

/**
 * Empresa Routes
 */
Route::resource('empresas', 'EmpresaController');

/**
 * Orcamento Routes
 */
Route::get('orcamentos/total', 'OrcamentoController@total');
Route::get('orcamentos/detail', 'OrcamentoController@detail');
Route::get('orcamentos/email', 'OrcamentoController@email');
Route::get('orcamentos/send', 'OrcamentoController@send');
Route::get('orcamentos/enviados', 'EmailController@index');
Route::get('orcamentos/{orcamento}/imprimir', 'OrcamentoController@imprimir');
Route::resource('orcamentos', 'OrcamentoController');

/**
 * Ajax Servico Routes
 */
Route::get('servicos/show', 'ServicoController@show');
Route::get('servicos/create', 'ServicoController@create');
Route::get('servicos/store', 'ServicoController@store');
Route::get('servicos/edit', 'ServicoController@edit');
Route::get('servicos/update', 'ServicoController@update');
Route::get('servicos/destroy', 'ServicoController@destroy');
Route::get('servicos/order', 'ServicoController@order');

/**
 * Ajax Produto Route
 */
Route::get('produtos/show', 'ProdutoController@show');
Route::get('produtos/create', 'ProdutoController@create');
Route::get('produtos/store', 'ProdutoController@store');
Route::get('produtos/edit', 'ProdutoController@edit');
Route::get('produtos/update', 'ProdutoController@update');
Route::get('produtos/destroy', 'ProdutoController@destroy');
Route::get('produtos/order', 'ProdutoController@order');

/**
 * Ajax Item Route
 */
Route::get('itens/show', 'ItemController@show');
Route::get('itens/create', 'ItemController@create');
Route::get('itens/store', 'ItemController@store');
Route::get('itens/edit', 'ItemController@edit');
Route::get('itens/update', 'ItemController@update');
Route::get('itens/destroy', 'ItemController@destroy');
Route::get('itens/order', 'ItemController@order');

/**
 * OrdemServico Routes
 */
Route::get('ordens-compra/detail', 'OrdemCompraController@detail');
Route::get('ordens-compra/relatorio', 'OrdemCompraController@relatorio');
Route::get('ordens-compra/relatorio/imprimir', 'OrdemCompraController@relatorioImprimir');
Route::get('ordens-compra/{ordemCompra}/imprimir', 'OrdemCompraController@imprimir');
Route::get('ordens-compra/{ordemCompra}/lancar', 'OrdemCompraController@lancar');
Route::resource('ordens-compra', 'OrdemCompraController');

/**
 * LogController Routes
 */
Route::get('logs/orcamentos', 'LogController@orcamento');
Route::get('logs/ordem-compras', 'LogController@ordemCompra');

/**
 * Integração Routes
 */
Route::get('integracao/orcamento', 'IntegracaoController@orcamento');
Route::get('integracao/orcamento/servicos', 'IntegracaoController@orcamentoServicos');
Route::get('integracao/orcamento/produtos', 'IntegracaoController@orcamentoProdutos');
Route::get('integracao/orcamento/total', 'IntegracaoController@orcamentoTotal');
Route::get('integracao/ordem-compra', 'IntegracaoController@ordemCompra');
Route::get('integracao/ordem-compra/itens', 'IntegracaoController@ordemCompraItens');
Route::get('integracao/log', 'IntegracaoController@log');

/**
 * ListaController Routes
 */
Route::resource('listas-de-contatos', 'ListaController');

/**
 * ContatoController Routes
 */
Route::resource('contatos', 'ContatoController');

/**
 * Auth Routes
 */
Route::auth();
