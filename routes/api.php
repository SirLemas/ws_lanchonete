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

Route::post('/usuarios', 'Api\UsuariosController@cadastrar');
Route::get('/usuarios', 'Api\UsuariosController@logar');


Route::group(['middleware' => ['jwt']], function() {
    Route::group(['prefix' => 'cardapio'], function() {
        Route::get('/', 'Api\CardapioController@listar');
        Route::get('/{id}', 'Api\CardapioController@buscar');
        Route::post('/', 'Api\CardapioController@cadastrar');
        Route::put('/{id}', 'Api\CardapioController@atualizar');
        Route::delete('/{id}', 'Api\CardapioController@deletar') ;
    });
});
